<?php
namespace App\Traits;
use Illuminate\Database\Schema\Blueprint;


trait MigrationHindiColumnTrait {


	public function addTranslateColoum(Blueprint $table)
	{
		$this->table = $table;
		return $this;
	}


	public function add( string $column_name = '' )
	{

		$this->columns =  $this->table->text('hi_'.$column_name );

		return $this;
	}


	public function after(string $column)
	{
		$this->columns->after($column);

		return $this;
	}


	public function nullable()
	{
		$this->columns->nullable();
		return $this;
	}


	public function dropColumn($column)
	{
		$table->dropColumn('hi_'.$column);
	}
}