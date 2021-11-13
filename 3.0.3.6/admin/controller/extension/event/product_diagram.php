<?php
class controllerExtensionEventProductDiagram extends Controller {
	
	public function view(&$view, &$data, &$output) {// triggered before view product form
		// build insert html
		return;
		if(isset($this->request->get['product_id']) && $this->request->get['product_id']) {
			$query = $this->db->query("select diagram from ".DB_PREFIX."product where product_id = '".(int)$this->request->get['product_id']."'");
			$info = $query->row;
		} else {
			$info = array(
				'diagram' => 0
			);
		}
		if($this->request->server['REQUEST_METHOD'] == 'POST') {
			// override with post
			$info = array(
				'diagram' => $this->request->post['diagram']?1:0
			);
		}
		$this->language->load('extension/module/product_diagram');
		// build insert
		$insert = '<div class="form-group"><label class="col-sm-2 control-label">';
		$insert .= '<span data-toggle="tooltip" title="'.$this->language->get('help_diagram').'">';
		$insert .= $this->language->get('text_diagram');
		$insert .= '</span></label>';
		$insert .= '<div class="col-sm-10">';
		$insert .= '<label class="radio-inline"><input type="radio" name="diagram" value="1"';
		$insert .= ((int)$info['diagram'])?' checked="checked">':'>';
		$insert .= $this->language->get('text_yes');
		$insert .= '</label>';
		$insert .= '<label class="radio-inline"><input type="radio" name="diagram" value="0"';
		$insert .= (!(int)$info['diagram'])?' checked="checked">':'>';
		$insert .= $this->language->get('text_no');
		$insert .= '</label>';
		$insert .= '</div>';
		$insert .= '</div>';
		// edit html
		$html = new simple_html_dom();
        $html->load($output, $lowercase = true, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);
		if($html === false) {
			$this->log->write('Unable to parse html!');
			$this->log->write($output);
			return;
		}
		foreach($html->find('#tab-data') as $node) {
			$node->innertext .= $insert;
		}
		foreach($html->find('#images') as $node) {
			$node->find('td',1)->innertext .= $this->language->get('text_sort_desc');
		}
		$output = $html->save();
	}
	
	public function save(&$route, &$data, &$output = null) {
		if((int)$output) {
			$id = $output;
			$temp = $data[0];
		} else {
			$temp = $data[1];
			$id = $data[0];
		}
		$this->load->model('tool/image');
		foreach($temp['product_image'] as $image) {
			$size = $this->model_tool_image->size($image['image']);
			$this->db->query("update ".DB_PREFIX."product_image set width = '".(int)$size['width']."', height = '".(int)$size['height']."' where image = '".$this->db->escape($image['image'])."'");
		}
		$this->db->query("update ".DB_PREFIX."product set diagram = '".(int)$temp['diagram']."' where product_id = '".(int)$id."'");
	}
	
	public function delete(&$route, &$data, &$output = null) {
		if((int)$output) {
			$id = $output;
			$temp = $data[0];
		} else {
			$temp = $data[1];
			$id = $data[0];
		}
		$this->load->model('extension/module/product_diagram');
		$this->model_extension_module_product_diagram->deleteLinks($id);
	}
	
	public function view_list(&$view, &$data, &$output = null) {
		$this->language->load('extension/module/product_diagram');
		$data['button_diagram'] = $this->language->get('button_diagram');
		$filter_diagram = '';
		if(isset($this->request->get['filter_diagram'])) {
			if($this->request->get['filter_diagram'] == '1')
				$filter_diagram = '1';
			if($this->request->get['filter_diagram'] == '0')
				$filter_diagram = '0';
		}
		$data['filter_diagram'] = $filter_diagram;
		$data['text_diagram'] = $this->language->get('text_diagram');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
	}
	
	public function filter(&$route, &$data, &$output = null) {
		if(isset($this->request->get['filter_diagram'])) {
			$data[0]['filter_diagram'] = $this->request->get['filter_diagram'];
		}
	}
	
	public function count(&$route, &$data, &$output = null) {
		if(isset($this->request->get['filter_diagram'])) {
			$data[0]['filter_diagram'] = $this->request->get['filter_diagram'];
		}
	}
}
