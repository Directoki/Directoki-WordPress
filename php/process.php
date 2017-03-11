<?php



/**
 *
 * @link https://github.com/directoki Directoki Open Source Software
 * @license https://github.com/Directoki/Directoki-WordPress/blob/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2017, JMB Technology Limited, http://jmbtechnology.co.uk/
 */

function Directoki_process_link(DirectokiModelLink $directokiModelLink) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $directokiModelLink->getListRecordsURL());
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Directoki WordPress from jmbtechnology.co.uk, site '.get_site_url());
	$dataString = curl_exec($ch);
	$response = curl_getinfo( $ch );
	curl_close($ch);
	$data = json_decode($dataString);

	foreach($data->records as $recordData) {
		Directoki_process_link_record($directokiModelLink, $recordData->id);
	}

}

function Directoki_process_link_record(DirectokiModelLink $directokiModelLink, $recordId) {

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $directokiModelLink->getRecordURL($recordId));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Directoki WordPress from jmbtechnology.co.uk, site '.get_site_url());
	$dataString = curl_exec($ch);
	$response = curl_getinfo( $ch );
	curl_close($ch);
	$data = json_decode($dataString);


	if ($data->record->published) {


		$postId = Directoki_db_get_record_link($directokiModelLink, $data->record->id);

		if ($postId) {

			wp_update_post(array(
				'ID'=>$postId,
				'post_title' => $data->fields->title->value->value, // TODO remove hard coded field name
				'post_status' => 'publish',
			));

		} else {

			$postId = wp_insert_post(array(
				'post_title' => $data->fields->title->value->value, // TODO remove hard coded field name
				'post_type' => $directokiModelLink->getWordPressPostType(),
				'post_status' => 'publish',
			));

			Directoki_db_save_record_link($directokiModelLink, $data->record->id, $postId);

		}

		foreach($data->fields as $fieldData) {

			$field = new DirectokiField($fieldData);

			update_post_meta($postId, $field->getTitle(), $field->getValue());
		}

	} else {
		// TODO
	}
}


