<?php

namespace App\Traits;
use Stichoza\GoogleTranslate\GoogleTranslate;


trait TranslatorTrait
{

	public function translate( )
	{

	  $translate = new GoogleTranslate();

	  $hindiArr = [];

	  try {

	  	foreach ( $this->translatable ?? []  as $key => $value )
		{

			if ( $this->guarded() ||  $this->isFillableAttribute( $value ) )
			{
				if ( $this->{$value} ) {
					$hindiArr = array_merge($hindiArr, [
				 			'hi_'.$value =>  $translate::trans($this->{$value}, 'hi', 'en')
				 		]);
				}

			}

		}
 		$this->update( $hindiArr );
 		return $this;

	  }

	  catch ( \Exception $e )
	  {
	  	dd($e->getMessage() );
	  }


	}

	public function isFillableAttribute($attribute)
	{
		return  in_array('hi_'.$attribute, $this->fillable);

	}

	public function guarded() {

		return empty( $this->guarded );

	}


}