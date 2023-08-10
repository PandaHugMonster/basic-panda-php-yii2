<?php

namespace app\components\layers;

use spaf\simputils\traits\SimpleObjectTrait;
use yii\db\ActiveRecord;

class ActiveRecordLayer extends ActiveRecord {
	use SimpleObjectTrait;

}
