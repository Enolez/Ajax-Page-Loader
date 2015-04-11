<?php
class qa_ajax_admin_form
{
	public function option_default($option)
	{
		if ($option === 'apl_container')
			return '.qa-body-wrapper';
	}


	public function admin_form(&$qa_content)
	{
		$saved = qa_clicked('apl_save_button');

		if ($saved) {
			qa_opt('apl_container', qa_post_text('apl_container'));
		}

		return array(
			'ok' => $saved ? 'Settings saved' : null,

			'fields' => array(
				array(
					'label' => 'Content Container(the html element which is used to load content)',
					'value' => qa_opt('apl_container'),
					'tags' => 'name="apl_container" id="apl_container"',
					'note' => 'default value for most themes is: <strong>".qa-body-wrapper"</strong>',
				),

			),

			'buttons' => array(
				array(
					'label' => 'Save Changes',
					'tags' => 'name="apl_save_button"',
				),
			),
		);
	}
}
