<?php
$stamping_materials = 
    assocQuery(
        $connection->query(
            'SELECT id_stamping_materials, name_of_material 
            FROM stamping_materials;')
    );

$news_querys = array_reduce($stamping_materials, function(mixed $carry, mixed $item)
{
    $new_item = array_merge($item, 
        [
            'material_images' =>
                assocQuery(
                    $connection->query(
                        'SELECT r.image_name, r.linck_image
                        FROM material_images AS m
                        JOIN resources_images AS r
                            ON r.id_resources_images = m.id_resources_images
                            WHERE m.id_stamping_materials = '.$item['id_stamping_materials'].';'
                    )
                )
        ]
    );
    $new_carry = array_merge($carry, $new_item);
    return $new_carry;
}, []);



[
    'SELECT m.id_resources_images, s.name_of_material 
        FROM material_images AS m 
        JOIN stamping_materials AS s 
            ON m.id_stamping_materials = s.id_stamping_materials
            WHERE m.id_resources_images BETWEEN 1 AND 10;',

    'SELECT s.name_of_material, r.image_name, r.linck_image
        FROM material_images AS m 
        JOIN stamping_materials AS s 
            ON m.id_stamping_materials = s.id_stamping_materials
        JOIN resources_images AS r
            ON r.id_resources_images = m.id_resources_images;',

    'SELECT  s.name_of_material, r.image_name, r.linck_image
        FROM stamping_materials AS s
        JOIN material_images AS m
            ON m.id_stamping_materials = s.id_stamping_materials
        JOIN resources_images AS r
            ON r.id_resources_images = m.id_resources_images;',
];