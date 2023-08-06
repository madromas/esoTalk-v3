<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

class AttachmentModel extends ETModel {

	public function __construct()
	{
		parent::__construct("attachment");
	}

	public function path()
	{
		return PATH_UPLOADS.'/attachments/';
	}

	public function mime($path)
	{
				$finfo = new finfo(FILEINFO_MIME_TYPE);
		return $finfo->file($path);
	}

	// Find attachments for a specific post or conversation that are being stored in the session, remove
	// them from the session, and return them.
	public function extractFromSession($postId)
	{
		$attachments = array();
		$session = (array)ET::$session->get("attachments");
		foreach ($session as $id => $attachment) {
			if ($attachment["postId"] == $postId) {
				$attachments[$id] = $attachment;
				unset($session[$id]);
			}
		}
		ET::$session->store("attachments", $session);

		return $attachments;
	}

	// Insert attachments in the database.
	public function insertAttachments($attachments, $keys)
	{
		$inserts = array();
		foreach ($attachments as $id => $attachment)
			$inserts[] = array_merge(array($id, $attachment["name"], $attachment["secret"]), array_values($keys));

		ET::SQL()
			->insert("attachment")
			->setMultiple(array_merge(array("attachmentId", "filename", "secret"), array_keys($keys)), $inserts)
			->exec();
	}

	public function removeFile($attachment)
	{
		@unlink($this->path().$attachment["attachmentId"].$attachment["secret"]);
		@unlink($this->path().$attachment["attachmentId"].$attachment["secret"]."_thumb");
	}

}
