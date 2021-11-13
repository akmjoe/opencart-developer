<?php
class ModelExtensionModuleProductDiagram extends Model {
	
	public function getLinks($product_id, $image_id = false) {
	    $sql = "SELECT d.*, p.model, p.product_id FROM `" . DB_PREFIX . "product_diagram` d join `".DB_PREFIX."product` p on d.link_id = p.product_id WHERE d.product_id = '".(int)$product_id."'";
		if($image_id !== false) {
			$sql .= " AND image_id = '".(int)$image_id."'";
		}
	    $sql .= " ORDER BY image_id ASC, y1 ASC, x1 ASC";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getPage($product_id, $link_id) {
		$sql = "select image_id from ".DB_PREFIX."product_diagram where product_id = '".(int)$product_id."' and link_id = '".(int)$link_id."' ORDER BY image_id = 0 asc, image_id asc limit 1";
		$result = $this->db->query($sql);
		return isset($result->row['image_id'])?$result->row['image_id']:0;
	}
	
	public function getDiagrams($product_id) {
		$sql = "SELECT DISTINCT p.product_id, pd.name, pd.description FROM " . DB_PREFIX . "product_diagram p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.link_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		$result = $this->db->query($sql);
		return $result->rows;
	}
	
	public function getProducts($product_id, $image_id = false, $data = array()) {
		$sql = "SELECT DISTINCT link_id FROM `" . DB_PREFIX . "product_diagram` WHERE product_id = '".(int)$product_id."'";
		if($image_id !== false) {
			$sql .= " AND image_id = '".(int)$image_id."'";
		}

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
		$return = array();
		foreach($query->rows as $row) {
			$return[] = $row['link_id'];
		}
		
		return $return;
	}
        
	public function isDiagram($product_id) {
		$result = $this->db->query("select diagram from ".DB_PREFIX."product where product_id = '".(int)$product_id."'");
		if(isset($result->row['diagram']) && $result->row['diagram']) {
			return true;
		} else {
			return false;
		}
	}
	
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
			// smaller than max
		} elseif($this->config->get('module_product_diagram_width')/$width < $this->config->get('module_product_diagram_height')/$height) {
			// use width
			$height = $height*($this->config->get('module_product_diagram_width')/$width);
			$width = $this->config->get('module_product_diagram_width');
		} else {
			// use height
			$width = $width*($this->config->get('module_product_diagram_height')/$height);
			$height = $this->config->get('module_product_diagram_height');
		}
		
		//$this->log->write('Using image size '.$width.' x '.$height);
		return array('width' => (int)$width, 'height' => (int)$height);
	}
}
