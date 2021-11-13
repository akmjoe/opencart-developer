<?php
class ModelExtensionModuleProductDiagram extends Model {
	public function install() {
		// box tables
		$this->db->query("
			CREATE TABLE `" . DB_PREFIX . "product_diagram` (
				`diagram_id` INT(11) NOT NULL AUTO_INCREMENT,
				`product_id` INT(11) NOT NULL,
				`link_id` INT(11) NOT NULL,
				`image_id` int(11),
				`x1` int(11),
				`x2` int(11),
				`y1` int(11),
				`y2` int(11),
				`date_modified` timestamp default '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY (`diagram_id`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
		");
		$this->db->query("ALTER TABLE ".DB_PREFIX."product add column diagram tinyint(1) not null default 0");
		$this->db->query("ALTER TABLE ".DB_PREFIX."product_image add column width int(11) not null default 0");
		$this->db->query("ALTER TABLE ".DB_PREFIX."product_image add column height int(11) not null default 0");
	}

	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "product_diagram`");
		$this->db->query("ALTER TABLE ".DB_PREFIX."product drop diagram");
		$this->db->query("ALTER TABLE ".DB_PREFIX."product_image drop width");
		$this->db->query("ALTER TABLE ".DB_PREFIX."product_image drop height");
	}
	/**
	 * Install sample data
	 */
	public function install_sample() {
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		// get a category
		$category = $this->model_catalog_category->getCategories();
		// Add product diagram
		$data = array(
				'model' => 'ProductDiagramDemo',
				'sku' => 'ProductDiagramDemo',
				'diagram' => 1,
				'image' => 'catalog/demo/product_diagram_main.jpg',
				'product_description' => array(
					'1' => array(
						'name' => '- Product Diagram Demo -',
						'description' => 'Demonstration of product diagram module',
						'meta_title' => 'Product Diagram Demo',
						'meta_description' => '',
						'meta_keyword' => '',
					)
				),
				'product_store' => array(0),
				'product_image' => array(
						array('image' => 'catalog/demo/product_diagram.jpg', 'sort_order' => 1, 'width' => 500, 'height' => 307)
				),
				'product_category' => array(
						$category[0]['category_id']
				),
				'upc' => '',
				'ean' => '',
				'jan' => '',
				'isbn' => '',
				'mpn' => '',
				'location' => '',
				'quantity' => '',
				'minimum' => '',
				'subtract' => '',
				'stock_status_id' => '',
				'date_available' => '',
				'manufacturer_id' => '',
				'shipping' => '',
				'price' => '',
				'points' => '',
				'weight' => '',
				'weight_class_id' => '',
				'length' => '',
				'width' => '',
				'height' => '',
				'length_class_id' => '',
				'status' => '1',
				'tax_class_id' => '',
				'sort_order' => '',
				'tag' => '',
				'orderable' => '',
				'backorderable' => '',
				'autodisable' => '',
				'callprice' => '',
		);
		$product_id = $this->model_catalog_product->addProduct($data);
		$query = $this->db->query("show tables like '" . DB_PREFIX . "product_advertise_google'");
		if($query->num_rows) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_advertise_google where product_id = ".(int)$product_id);
		}
		// add monitor
		$data = array(
				'model' => 'ProductDiagramDemo1',
				'sku' => 'ProductDiagramDemo1',
				'diagram' => 0,
				'image' => 'catalog/demo/monitor.jpg',
				'product_description' => array(
					'1' => array(
						'name' => 'Monitor',
						'description' => 'Replacement monitor for desktop',
						'meta_title' => 'Monitor',
						'meta_description' => '',
						'meta_keyword' => '',
					)
				),
				'product_store' => array(0),
				'quantity' => 10,
				'price' => 99.99,
				'upc' => '',
				'ean' => '',
				'jan' => '',
				'isbn' => '',
				'mpn' => '',
				'location' => '',
				'quantity' => '',
				'minimum' => '',
				'subtract' => '',
				'stock_status_id' => '',
				'date_available' => '',
				'manufacturer_id' => '',
				'shipping' => '',
				'points' => '',
				'weight' => '',
				'weight_class_id' => '',
				'length' => '',
				'width' => '',
				'height' => '',
				'length_class_id' => '',
				'status' => '1',
				'tax_class_id' => '',
				'sort_order' => '',
				'tag' => '',
				'orderable' => '1',
				'backorderable' => '',
				'autodisable' => '',
				'callprice' => '',
		);
		$area = array('product_id' => $product_id, 'image_id' => 1, 'x1' => 340, 'x2' => 800, 'y1' => 90, 'y2' => 480);
		$area['link_id'] = $this->model_catalog_product->addProduct($data);
		$query = $this->db->query("show tables like '" . DB_PREFIX . "product_advertise_google'");
		if($query->num_rows) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_advertise_google where product_id = ".(int)$area['link_id']);
		}
		$this->addLink($area);
		// add keyboard
		$data['model'] = 'ProductDiagramDemo2';
		$data['sku'] = 'ProductDiagramDemo2';
		$data['image'] = '';
		$data['price'] = 39.99;
		$data['product_description']['1']['name'] = 'USB Keyboard';
		$data['product_description']['1']['description'] = 'Universal USB Keyboard';
		$data['product_description']['1']['meta_title'] = 'USB Keyboard';
		$area = array('product_id' => $product_id, 'image_id' => 1, 'x1' => 225, 'x2' => 730, 'y1' => 480, 'y2' => 590);
		$area['link_id'] = $this->model_catalog_product->addProduct($data);
		$query = $this->db->query("show tables like '" . DB_PREFIX . "product_advertise_google'");
		if($query->num_rows) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_advertise_google where product_id = ".(int)$area['link_id']);
		}
		$this->addLink($area);
		// Add mouse
		$data['model'] = 'ProductDiagramDemo3';
		$data['sku'] = 'ProductDiagramDemo3';
		$data['image'] = '';
		$data['price'] = 19.99;
		$data['product_description']['1']['name'] = 'USB Mouse';
		$data['product_description']['1']['description'] = '3 button USB mouse. Features a smooth scroll wheel, invisible laser, 3 foot cable and ergonomic design. With plug-and-play, there is no need to install additional drivers to use. Works on Windows, Mac and Linux.';
		$data['product_description']['1']['meta_title'] = 'USB mouse';
		$area = array('product_id' => $product_id, 'image_id' => 1, 'x1' => 750, 'x2' => 900, 'y1' => 490, 'y2' => 590);
		$area['link_id'] = $this->model_catalog_product->addProduct($data);
		$query = $this->db->query("show tables like '" . DB_PREFIX . "product_advertise_google'");
		if($query->num_rows) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_advertise_google where product_id = ".(int)$area['link_id']);
		}
		$this->addLink($area);
		// Add unlisted
		$data['model'] = 'ProductDiagramDemo4';
		$data['sku'] = 'ProductDiagramDemo4';
		$data['image'] = 'catalog/demo/product_diagram_main.jpg';
		$data['price'] = 9.99;
		$data['product_description']['1']['name'] = 'Product not on image';
		$data['product_description']['1']['description'] = 'This is a product not shown on the diagram.';
		$data['product_description']['1']['meta_title'] = 'USB mouse';
		$area = array('product_id' => $product_id, 'image_id' => 0, 'x1' => 0, 'x2' => 0, 'y1' => 0, 'y2' => 0);
		$area['link_id'] = $this->model_catalog_product->addProduct($data);
		$query = $this->db->query("show tables like '" . DB_PREFIX . "product_advertise_google'");
		if($query->num_rows) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "product_advertise_google where product_id = ".(int)$area['link_id']);
		}
		$this->addLink($area);
		// add to featured
		$this->load->model('setting/module');
		$featured = $this->model_setting_module->getModulesByCode('featured');
		foreach($featured as $module) {
			$setting = $this->model_setting_module->getModule($module['module_id']);
			array_unshift($setting['product'], (string)$product_id);
			$this->model_setting_module->editModule($module['module_id'], $setting);
		}
		return $product_id;
	}
	/**
	 * Remove sample data
	 */
	public function uninstall_sample() {
		// remove from featured
		$this->load->model('setting/module');
		$featured = $this->model_setting_module->getModulesByCode('featured');
		foreach($featured as $module) {
			$setting = $this->model_setting_module->getModule($module['module_id']);
			foreach($setting['product'] as $key => $product) {
				if($product == $this->config->get('module_product_diagram_sample')) unset($setting['product'][$key]);
			}
			$this->model_setting_module->editModule($module['module_id'], $setting);
		}
		$this->load->model('catalog/product');
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product where model like 'ProductDiagramDemo%'");
		foreach($query->rows as $row) {
			$this->model_catalog_product->deleteProduct($row['product_id']);
		}
		$this->model_catalog_product->deleteProduct((int)$this->config->get('module_product_diagram_sample'));
	}
	/**
	 * Add a new link area. Returns new link ID
	 * @param array $data
	 * @return int
	 */
	public function addLink($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "product_diagram SET product_id = '" . (int)$data['product_id'] . "', link_id = '" . (int)$data['link_id'] . "', image_id = '" . (int)$data['image_id'] . "', x1 = '" . (int)$data['x1'] . "', x2 = '" . (int)$data['x2'] . "', y1 = '" . (int)$data['y1'] . "', y2 = '" . (int)$data['y2'] . "'");
		return $this->db->getLastId();
	}
	/**
	 * Update a link area. Returns the link ID
	 * @param array $data
	 * @return int
	 */
	public function saveLink($data) {
		
		$this->db->query("UPDATE " . DB_PREFIX . "product_diagram SET product_id = '" . (int)$data['product_id'] . "', link_id = '" . (int)$data['link_id'] . "', image_id = '" . (int)$data['image_id'] . "', x1 = '" . (int)$data['x1'] . "', x2 = '" . (int)$data['x2'] . "', y1 = '" . (int)$data['y1'] . "', y2 = '" . (int)$data['y2'] . "' WHERE diagram_id = '".(int)$data['diagram_id']."'");
		return $data['diagram_id'];
	}
	/**
	 * Remove specific link area by ID
	 * @param int $diagram_id
	 */
	public function deleteLink($diagram_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_diagram WHERE diagram_id = '" . (int)$diagram_id . "'");
	}
	/**
	 * Remove all links from a diagram (clear)
	 * If image_id is provided, it will only clear that image. Otherwise it will clear all
	 * @param int $product_id
	 * @param int $image_id
	 */
	public function deleteLinks($product_id, $image_id = false) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_diagram WHERE product_id = '".(int)$product_id."'".($image_id !== false?(" and image_id = '".(int)$image_id."'"):''));
	}
	/**
	 * Get an array of all link areas for the specified product_id
	 * If image_id is provided, will only be for that image; otherwise, will get all
	 * @param int $product_id
	 * @param int $image_id
	 * @return array
	 */
	public function getLinks($product_id, $image_id = false) {
	    $sql = "SELECT d.*, p.".$this->config->get('module_product_diagram_key')." as model FROM `" . DB_PREFIX . "product_diagram` d join `".DB_PREFIX."product` p on d.link_id = p.product_id WHERE d.product_id = '".(int)$product_id."'";
		if($image_id !== false) {
			$sql .= " AND image_id = '".(int)$image_id."'";
		}
	    $sql .= " ORDER BY image_id ASC";

		    if (isset($data['start']) || isset($data['limit'])) {
			    if ($data['start'] < 0) {
				    $data['start'] = 0;
			    }

			    if ($data['limit'] < 1) {
				    $data['limit'] = 20;
			    }

			    $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		    }
		    $query = $this->db->query($sql);
		    
		    return $query->rows;
	}
	/**
	 * Get array of image_id's for product_id
	 * @param int $product_id
	 * @return array
	 */
	public function getImages($product_id) {
		$return = array();
		$sql = "SELECT DISTINCT image_id FROM `" . DB_PREFIX . "product_diagram` WHERE product_id = '".(int)$product_id."'";
		$query = $this->db->query($sql);
		foreach($query->rows as $row) {
			$return[] = $row['image_id'];
		}
		return $return;
	}
	/**
	 * Calculate image display size from actual image size and max settings
	 * @param int $width
	 * @param int $height
	 * @param int $image_id
	 * @return array
	 */
	public function displaySize($width = 0, $height = 0, $image_id = 0) {
		if((!$width || !$height) && $image_id) {
			// get width and height from db
			$result = $this->db->query("select width, height from ".DB_PREFIX."product_image where image_id = '".(int)$image_id."'");
			$width = (int)$result->row['width'];
			$height = (int)$result->row['height'];
		}
		if(!$width || !$height) {
			return array('width' => 0, 'height' => 0);
		}
		// calculate width and height based on max and actual
		if($width <= $this->config->get('module_product_diagram_width') && $height <= $this->config->get('module_product_diagram_height')) {
			// smaller than max - use actual
		} elseif($this->config->get('module_product_diagram_width')/$width < $this->config->get('module_product_diagram_height')/$height) {
			// use width
			$height = $height*($this->config->get('module_product_diagram_width')/$width);
			$width = $this->config->get('module_product_diagram_width');
		} else {
			// use height
			$width = $width*($this->config->get('module_product_diagram_height')/$height);
			$height = $this->config->get('module_product_diagram_height');
		}
		return array('width' => (int)$width, 'height' => (int)$height);
	}
	
}
