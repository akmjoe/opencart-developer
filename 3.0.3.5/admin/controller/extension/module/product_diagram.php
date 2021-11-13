<?php
class ControllerExtensionModuleProductDiagram extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/product_diagram');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$this->model_setting_setting->editSetting('module_product_diagram', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}

		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/product_diagram', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/product_diagram', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['module_product_diagram_status'])) {
			$data['module_product_diagram_status'] = $this->request->post['module_product_diagram_status'];
		} else {
			$data['module_product_diagram_status'] = $this->config->get('module_product_diagram_status');
		}

		if (isset($this->request->post['module_product_diagram_key'])) {
			$data['module_product_diagram_key'] = $this->request->post['module_product_diagram_key'];
		} else {
			$data['module_product_diagram_key'] = $this->config->get('module_product_diagram_key');
		}

		if (isset($this->request->post['module_product_diagram_width'])) {
			$data['module_product_diagram_width'] = $this->request->post['module_product_diagram_width'];
		} elseif((int)$this->config->get('module_product_diagram_width')) {
			$data['module_product_diagram_width'] = $this->config->get('module_product_diagram_width');
		} else {
			$data['module_product_diagram_width'] = 1000;
		}

		if (isset($this->request->post['module_product_diagram_height'])) {
			$data['module_product_diagram_height'] = $this->request->post['module_product_diagram_height'];
		} elseif((int)$this->config->get('module_product_diagram_height')) {
			$data['module_product_diagram_height'] = $this->config->get('module_product_diagram_height');
		} else {
			$data['module_product_diagram_height'] = 1600;
		}
		
		if (isset($this->request->post['module_product_diagram_column'])) {
			$data['module_product_diagram_column'] = $this->request->post['module_product_diagram_column'];
		} else {
			$data['module_product_diagram_column'] = $this->config->get('module_product_diagram_column');
		}
		
		if($this->config->get('module_product_diagram_sample')) {
			$data['entry_button'] = $this->language->get('button_remove_sample');
			$data['link_sample'] = HTTP_CATALOG . 'index.php?route=product/product&product_id='.$this->config->get('module_product_diagram_sample');
			$data['link_admin'] = HTTP_SERVER . 'index.php?route=extension/module/product_diagram/edit&product_id='.$this->config->get('module_product_diagram_sample').'&user_token='.$this->session->data['user_token'];
		} else {
			$data['entry_button'] = $this->language->get('button_install_sample');
		}
		
		
		$data['module_product_diagram_sample'] = $this->config->get('module_product_diagram_sample');
		$data['user_token'] = $this->session->data['user_token'];

		$data['fields'] = array(
			'model',
			'name'
		);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		
		$this->response->setOutput($this->load->view('extension/module/product_diagram', $data));
	}
	
	public function install() {
		// add db tables
		$this->load->model('extension/module/product_diagram');
		$this->model_extension_module_product_diagram->install();
		$this->config->set('module_product_diagram_width','800');
		$this->config->set('module_product_diagram_height','800');
		// set up event handlers
		$this->load->model('setting/event');
		// Modify admin page
		$this->model_setting_event->addEvent('product_diagram', 'admin/view/catalog/product_form/after', 'extension/event/product_diagram/view');
		$this->model_setting_event->addEvent('product_diagram', 'admin/view/catalog/product_list/before', 'extension/event/product_diagram/view_list');
		$this->model_setting_event->addEvent('product_diagram', 'admin/model/catalog/product/getProducts/before', 'extension/event/product_diagram/filter');
		$this->model_setting_event->addEvent('product_diagram', 'admin/model/catalog/product/getTotalProducts/before', 'extension/event/product_diagram/count');
		$this->model_setting_event->addEvent('product_diagram', 'admin/model/catalog/product/addProduct/after', 'extension/event/product_diagram/save');
		$this->model_setting_event->addEvent('product_diagram', 'admin/model/catalog/product/editProduct/after', 'extension/event/product_diagram/save');
		$this->model_setting_event->addEvent('product_diagram', 'admin/model/catalog/product/deleteProduct/after', 'extension/event/product_diagram/delete');
		// Modify catalog page
		$this->model_setting_event->addEvent('product_diagram', 'catalog/view/product/category/before', 'extension/event/product_diagram/category');
		$this->model_setting_event->addEvent('product_diagram', 'catalog/view/product/search/before', 'extension/event/product_diagram/category');
		$this->model_setting_event->addEvent('product_diagram', 'catalog/view/product/special/before', 'extension/event/product_diagram/category');
		$this->model_setting_event->addEvent('product_diagram', 'catalog/view/extension/module/*/before', 'extension/event/product_diagram/category');
		$this->model_setting_event->addEvent('product_diagram', 'catalog/controller/product/product/before', 'extension/event/product_diagram/product');
		$this->model_setting_event->addEvent('product_diagram', 'catalog/controller/product/category/before', 'extension/event/product_diagram/category_path');
		$this->model_setting_event->addEvent('product_diagram', 'catalog/view/product/product/before', 'extension/event/product_diagram/product_view');
		$this->model_setting_event->addEvent('product_diagram', 'catalog/controller/checkout/cart/add/before', 'extension/event/product_diagram/product_cart');
	}
	
	public function uninstall() {
		// remove db table
		$this->load->model('extension/module/product_diagram');
		$this->model_extension_module_product_diagram->uninstall();
		// remove events
		$this->load->model('setting/event');
		$this->model_setting_event->deleteEventByCode('product_diagram');
	}
	
	public function import() {
		// imports data from zencart tables
		$table = 'products_diagram';
		// add images as extra images
		$this->load->model('tool/image');
		$result = $this->db->query('select distinct products_diagram_image_name, products_diagram_product_id from '.$table.' where products_diagram_image_name != ""');
		foreach($result->rows as $row) {
			$size = $this->model_tool_image->size('catalog/diagrams/'.$row['products_diagram_image_name']);
			$sort = $row['products_diagram_image_name']?preg_replace('/[^0-9]/', '', explode('_', $row['products_diagram_image_name'])[1]):0;
			$this->db->query("insert into ".DB_PREFIX."product_image set product_id = '".$this->db->escape($row['products_diagram_product_id'])."', image = 'catalog/diagrams/".$this->db->escape($row['products_diagram_image_name'])."', sort_order = '".$sort."', width = '".(int)$size['width']."', height = '".(int)$size['height']."'");
			$this->db->query("update ".DB_PREFIX."product set diagram = 1 where product_id = '".(int)$row['products_diagram_product_id']."'");
		}
		// now add clickable links
		$result = $this->db->query('select d.*, p.product_id from '.$table.' d JOIN '.DB_PREFIX.'product p on d.products_diagram_product_link = p.model');
		foreach($result->rows as $row) {
			$sort = $row['products_diagram_image_name']?preg_replace('/[^0-9]/', '', explode('_', $row['products_diagram_image_name'])[1]):0;
			$sql = "insert into ".DB_PREFIX."product_diagram set product_id = '".(int)$row['products_diagram_product_id']."', link_id = '".(int)$row['product_id']."', image_id = '".(int)$sort."', x1 = '".(int)$row['products_diagram_x1']."', x2 = '".(int)$row['products_diagram_x2']."', y1 = '".(int)$row['products_diagram_y1']."', y2 = '".(int)$row['products_diagram_y2']."'";
			$this->db->query($sql);
		}
	}
	public function edit() {
		// edit product diagram image map
		$data = $this->load->language('extension/module/product_diagram');
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if (isset($this->request->get['filter_diagram'])) {
			$url .= '&filter_diagram=' . $this->request->get['filter_diagram'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'] . $url, true)
		);
		
		$data['action'] = $this->url->link('extension/module/product_diagram/save', 'user_token=' . $this->session->data['user_token'] . $url, true);

		$data['cancel'] = $this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'] . $url, true);
		
		$data['key'] = $this->config->get('module_product_diagram_key');

		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		$this->load->model('extension/module/product_diagram');
		// get product info
		$product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
			
		$data['product'] = $product_info;
		$data['link'] = HTTP_CATALOG . 'index.php?route=product/product&product_id='.$this->request->get['product_id'];
		// get product images
		$product_images = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
		$data['product_images'] = array();

		foreach ($product_images as $product_image) {
			if (is_file(DIR_IMAGE . $product_image['image'])) {
				$image = $product_image['image'];
				$thumb = $product_image['image'];
				$size = $this->model_extension_module_product_diagram->displaySize($product_image['width'], $product_image['height']);
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['product_images'][$product_image['sort_order']] = array(
				'image'      => $this->model_tool_image->resize($image, $size['width'], $size['height']),
				'width'		 =>  $size['width'],
				'height'	 =>  $size['height'],
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
				'sort_order' => $product_image['sort_order'],
			);
			
		}
		// get non-mapped products
		$data['linked'] = $this->model_extension_module_product_diagram->getLinks($this->request->get['product_id'],0);
		
		// get image maps
		foreach($this->model_extension_module_product_diagram->getImages($this->request->get['product_id']) as $image) {
			$data['maps'][$image] = $this->model_extension_module_product_diagram->getLinks($this->request->get['product_id'],$image);
		}
		// now get a list of extra maps
		$data['extra_map'] = array();
		foreach($this->model_extension_module_product_diagram->getImages($this->request->get['product_id']) as $image) {
			if((int)$image && !array_key_exists($image, $data['product_images'])) {
				// map with no image
				$data['extra_map'][$image] = $this->model_extension_module_product_diagram->getLinks($this->request->get['product_id'],$image);
			}
		}
		$this->document->addStyle('view/stylesheet/product_diagram.css');

		$data['user_token'] = $this->session->data['user_token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/product_diagram_edit', $data));
	}
	
	public function save() {
		// saves linked products (not on image map)
		$this->load->language('extension/module/product_diagram');
		if($this->request->server['REQUEST_METHOD'] == 'POST' && isset($this->request->post['product_id'])) {
			$this->load->model('extension/module/product_diagram');
			$this->model_extension_module_product_diagram->deleteLinks((int)$this->request->post['product_id'],0);
			if(isset($this->request->post['item']) && is_array($this->request->post['item']) && count($this->request->post['item'])) {
				// save links
				foreach($this->request->post['item'] as $link) {
					$add = array(
							'product_id' => (int)$this->request->post['product_id'],
							'image_id' => 0,
							'link_id' => (int)$link['link_id'],
							'x1' => 0,
							'x2' => 0,
							'y1' => 0,
							'y2' => 0,
							
					);
					$this->model_extension_module_product_diagram->addLink($add);
				}
			}
			if(isset($this->request->post['extra_map']) && is_array($this->request->post['extra_map']) && count($this->request->post['extra_map'])) {
				foreach($this->request->post['extra_map'] as $key => $value) {
					switch($value) {
						case 'ignore':
							break;
						case 'delete':
							$this->model_extension_module_product_diagram->deleteLinks((int)$this->request->post['product_id'],(int)$key);
							break;
						case 'unlink':
							$this->db->query("update ".DB_PREFIX."product_diagram set image_id = '0' where product_id = '".(int)$this->request->post['product_id']."' and image_id = '".(int)$key."'");
							break;
						default:
							if((int)$value)
								$this->db->query("update ".DB_PREFIX."product_diagram set image_id = '".(int)$value."' where product_id = '".(int)$this->request->post['product_id']."' and image_id = '".(int)$key."'");
					}
				}
			}
		}
		// now redirect
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if (isset($this->request->get['filter_diagram'])) {
			$url .= '&filter_diagram=' . $this->request->get['filter_diagram'];
		}
		
		$this->response->redirect($this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'] . $url, true));
	}
	
	public function remove() {
		$this->load->language('extension/module/product_diagram');
		// Image map area add/edit/delete
		$json = array();
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->load->model('extension/module/product_diagram');
			if(isset($this->request->post['diagram_id']) && (int)$this->request->post['diagram_id']) {
				$this->model_extension_module_product_diagram->deleteLink((int)$this->request->post['diagram_id']);
				$json['success'] = true;
			} else {
				$json['error']['warning'] = $this->language->get('error_id');
			}
			$json['name'] = isset($this->request->post['name'])?$this->request->post['name']:'';
			$json['image_id'] = isset($this->request->post['image_id'])?$this->request->post['image_id']:'';
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function area() {
		$this->load->language('extension/module/product_diagram');
		// Image map area add/edit/delete
		$json = array();
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			// check that all info received
			if(isset($this->request->post['x']) && (int)$this->request->post['x'] && (int)$this->request->post['x'] > 0) {
				$area['x1'] = (int)$this->request->post['x'];
			} else {
				$area['x1'] = 0;
				$json['error']['x'] = $this->language->get('error_x');
			}
			if(isset($this->request->post['y']) && (int)$this->request->post['y'] && (int)$this->request->post['y'] > 0) {
				$area['y1'] = (int)$this->request->post['y'];
			} else {
				$area['y1'] = 0;
				$json['error']['y'] = $this->language->get('error_y');
			}
			if(isset($this->request->post['width']) && (int)$this->request->post['width']) {
				$area['x2'] = (int)$this->request->post['width']+$area['x1'];
			} else {
				$json['error']['width'] = $this->language->get('error_width');
			}
			if(isset($this->request->post['height']) && (int)$this->request->post['height']) {
				$area['y2'] = (int)$this->request->post['height']+$area['y1'];
			} else {
				$json['error']['height'] = $this->language->get('error_height');
			}
			if(isset($this->request->post['product_id']) && (int)$this->request->post['product_id']) {
				$area['product_id'] = (int)$this->request->post['product_id'];
			} else {
				$json['error']['product_id'] = $this->language->get('error_product');
			}
			if(isset($this->request->post['link_id']) && (int)$this->request->post['link_id']) {
				$area['link_id'] = (int)$this->request->post['link_id'];
			} else {
				$json['error']['link_id'] = $this->language->get('error_link');
			}
			if(isset($this->request->post['image_id']) && (int)$this->request->post['image_id']) {
				$area['image_id'] = (int)$this->request->post['image_id'];
			} else {
				$area['image_id'] = 0;
			}
			if(!$json) {// save
				$this->load->model('extension/module/product_diagram');
				if(isset($this->request->post['diagram_id']) && (int)$this->request->post['diagram_id']) {
					$area['diagram_id'] = (int)$this->request->post['diagram_id'];
					$this->model_extension_module_product_diagram->saveLink($area);
				} else {
					$area['diagram_id'] = $this->model_extension_module_product_diagram->addLink($area);
				}
				$json['success'] = true;
				$json['diagram_id'] = $area['diagram_id'];
			} else {
				$json['error']['warning'] = implode('<br>', $json['error']);
			}
			$json = array_merge($this->request->post, $json);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function sample() {
		error_reporting(0);// disable error messages that will cause a problem
		$this->load->language('extension/module/product_diagram');
		// Sample Data add/delete
		$json = array();
		$this->load->model('extension/module/product_diagram');
		if($this->request->server['REQUEST_METHOD'] == 'POST' && (int)$this->request->post['module_product_diagram_sample']) {
			// remove
			$json['sample'] = $this->model_extension_module_product_diagram->uninstall_sample();
			$json['button'] = $this->language->get('button_install_sample');
			$json['success'] = $this->language->get('text_remove_sample');
		} else {
			// add
			$json['sample'] = $this->model_extension_module_product_diagram->install_sample();
			$json['button'] = $this->language->get('button_remove_sample');
			$json['success'] = $this->language->get('text_install_sample');
			$json['link'] = HTTP_CATALOG . 'index.php?route=product/product&product_id='.$json['sample'];
			$json['admin'] = HTTP_SERVER . 'index.php?route=extension/module/product_diagram/edit&product_id='.$json['sample'].'&user_token='.$this->session->data['user_token'];
		}
		$this->load->model('setting/setting');
		$this->model_setting_setting->editSettingValue('module_product_diagram', 'module_product_diagram_sample', $json['sample']);
		
		$this->config->set('module_product_diagram_sample', $json['sample']);
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	


	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/product_diagram')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!(int)$this->request->post['module_product_diagram_width']) {
			$this->error['width'] = $this->language->get('error_w');
		}
		if (!(int)$this->request->post['module_product_diagram_height']) {
			$this->error['height'] = $this->language->get('error_h');
		}
		

		return !$this->error;
	}
}