<?php

namespace App\Models\Auth;

use App\Models\Model;
use LionSql\QueryBuilder as Builder;

class DocumentTypesModel extends Model {

	public function __construct() {
		$this->init();
	}

	public function readDocumentTypesDB(): array {
		return Builder::select('fetchAll', 'document_types');
	}

}