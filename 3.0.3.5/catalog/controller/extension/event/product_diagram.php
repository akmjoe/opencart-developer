<?php
class controllerExtensionEventProductDiagram extends Controller {
    public function product(&$route, &$data = array(), &$output = '') {
        $this->load->model('catalog/category');
        $this->load->model('setting/setting');
        // check if this module is enabled
        if(!$this->config->get('module_product_diagram_status')) {
            return;
        }
		if(isset($this->request->get['product_id']) && !isset($this->request->get['path'])) {
			// get category from product
			$query = $this->db->query('select c.category_id, c.parent_id from '.DB_PREFIX.'product_to_category p join '.DB_PREFIX.'category c on (c.category_id = p.category_id) LEFT JOIN ' . DB_PREFIX . 'category_to_store c2s ON (c.category_id = c2s.category_id)  where product_id = "'.(int)$this->request->get['product_id'].'" and c2s.store_id = "' . (int)$this->config->get('config_store_id') . '" ORDER BY sort_order ASC LIMIT 1');
			// now we need full path
			if($query->num_rows) {
				$category_path = $query->row['category_id'];
				$parent = $query->row['parent_id'];
				while($parent) {
					$category_path = $parent.'_'.$category_path;
					$next = $this->model_catalog_category->getCategory($parent);
					if(is_array($next)) {
						$parent = $next['parent_id'];
					} else {
						$parent = 0;
					}
				}
				// set path for breadcrumbs
				$this->request->get['path'] = $category_path;
			}
		}
		if(isset($this->request->get['product_id'])) {
			// check if product diagram
			$query = $this->db->query('select diagram from '.DB_PREFIX.'product where product_id = "'.(int)$this->request->get['product_id'].'"');
			if($query->num_rows && $query->row['diagram']) {
				// redirect to handler page in background
				$params = array(
					'path' => isset($this->request->get['path'])?$this->request->get['path']:'',
					'product_id' => $this->request->get['product_id']
					);
				$this->load->controller('extension/module/product_diagram');
				return true;// override default handler
			}
		}
    }
    
    public function category_path(&$route, &$data = array(), &$output = '') {
		$parts = explode('_', (string)$this->request->get['path']);
		$category_id = (int)array_pop($parts);
		if(!count($parts)) {// single category, not path
			$this->load->model('catalog/category');
			$category = $this->model_catalog_category->getCategory($category_id);
			
			if($category && $category['parent_id']) {// has parent - get full path
				$category_path = $category['category_id'];
				$parent = $category['parent_id'];
				while($parent) {
					$category_path = $parent.'_'.$category_path;
					$next = $this->model_catalog_category->getCategory($parent);
					if(is_array($next)) {
						$parent = $next['parent_id'];
					} else {
						$parent = 0;
					}
				}
				// set path for breadcrumbs
				$this->request->get['path'] = $category_path;
			}
		}
	}
	
    public function category(&$route, &$data = array(), &$output = '') {
        $this->load->model('extension/module/product_diagram');
        // check if this module is enabled
        if(!$this->config->get('module_product_diagram_status')) {
            return;
        }
		if(isset($data['products']) && is_array($data['products']) && count($data['products'])) {
			foreach($data['products'] as &$value) {
				if($this->model_extension_module_product_diagram->isDiagram($value['product_id'])) {
					$value['price'] = '';
					$value['diagram'] = 1;
				}
			}
		}
    }
	
    public function product_view(&$route, &$data = array(), &$output = '') {
        // check if this module is enabled
        if(!$this->config->get('module_product_diagram_status')) {
            return;
        }
		$this->load->language('extension/module/product_diagram');
		$data['text_diagrams'] = $this->language->get('text_diagrams');
        $this->load->model('extension/module/product_diagram');
		if(is_array($data['products']) && count($data['products'])) {
			foreach($data['products'] as &$value) {
				if($this->model_extension_module_product_diagram->isDiagram($value['product_id'])) {
					$value['price'] = '';
					$value['diagram'] = 1;
				}
			}
		}
		// now add diagram links
		$diagrams = $this->model_extension_module_product_diagram->getDiagrams($data['product_id']);
		$data['diagrams'] = array();
		foreach($diagrams as $diagram) {
			$data['diagrams'][] = array(
					'name' => $diagram['name'],
					'description' => $diagram['description'],
					'href' => $this->url->link('product/product', 'product_id=' . $diagram['product_id'] . '&link_id=' . $data['product_id'])
			);
		}
    }
	
	public function product_cart(&$route, &$data = array(), &$output = '') {
        // check if this module is enabled
        if(!$this->config->get('module_product_diagram_status')) {
            return;
        }
		if(isset($this->request->post['product_id'])) {
			// check if product diagram
			$query = $this->db->query('select diagram from '.DB_PREFIX.'product where product_id = "'.(int)$this->request->post['product_id'].'"');
			if($query->num_rows && $query->row['diagram']) {
				// redirect to page
				$json['redirect'] = str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']));
				$this->response->addHeader('Content-Type: application/json');
				$this->response->setOutput(json_encode($json));
				return true;// override default handler
			}
		}
	}
}
