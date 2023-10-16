<?php
class Model_contacts extends Model
{
	public function get_data()
	{	
		// Здесь мы просто симулируем реальные данные.
		return array(
			array(
				'name' => '"SF-AdTech"',
				'adress' => 'г.Судогда',
				'email' => 'admin@sfadtech.com'
			),
			
		);
	}
}