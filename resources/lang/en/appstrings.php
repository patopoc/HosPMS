<?php
return [
		"item_removed" => ":item removed successfully",
		"models" => [
				"actions" => "Acciones",
				"person" => [
						"titleList" => "People",
						"titleCreate" => "New Person",
						"titleEdit" => "Edit Person:",
						"labels" => [
							"ci" => "CI",
							"name" => "Nombre",
							"last_name" => "Apellido",
							"email" => "Email",
							"telephone" =>"Telefono",
							"id_country" => "Pais",
							"country" => "Pais"
						]
				],
				"facility_plan" => [
						"titleList" => "",
						"titleCreate" => "New Facility Plan",
						"titleEdit" => "",
						"labels" => [
							"name" => "Nombre",
							"facilities" => "Facilities"
						]
						
				],
				"department" => [
						"titleList" => "Department",
						"titleCreate" => "New Department",
						"titleEdit" => "Edit Department:",
						"labels" => [								
								"name" => "Name",
								"description" => "Description",								
						]
				],
				"staff" => [
						"titleList" => " :staff_type Staff",
						"titleCreate" => "New ",
						"titleEdit" => "Edit:",
						"labels" => [	
								"ci" => "CI",
								"name" => "Nombre",
								"last_name" => "Apellido",
								"email" => "Email",
								"telephone" =>"Telefono",
								"id_country" => "Pais",
								"country" => "Pais",
								"department" => "Department",
								"id_department" => "Department",
								"id_staff_type" => "Staff Type",
								"profile" => "Profile"
						]
				],
				"staff_type" => [
						"titleList" => "Staff Types",
						"titleCreate" => "New Staff Type",
						"titleEdit" => "Edit Staff Type:",
						"labels" => [
								"name" => "Name",
								"description" => "Description"
						]
				],
				"patient" => [
						"titleList" => "Patients List",
						"titleCreate" => "New Patient",
						"titleEdit" => "Edit Patient:",
						"labels" => [
								"ci" => "CI",
								"name" => "Nombre",
								"last_name" => "Apellido",
								"full_name" => "Name",
								"email" => "Email",
								"gender" => "Gender",
								"telephone" =>"Telefono",
								"birth_date" => "Birth Date",								
								"id_country" => "Pais",
								"country" => "Pais",
								"id_blood_group" => "Blood Group",
								"blood_group" => "Blood Group",
								"id_picture" => "Picture"
						]
				],
		]
];