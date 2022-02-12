SELECT m.id_resources_images, s.name_of_material 
    FROM material_images AS m 
    JOIN stamping_materials AS s 
        ON m.id_stamping_materials = s.id_stamping_materials
        WHERE m.id_resources_images BETWEEN 1 AND 10;


SELECT s.name_of_material, r.image_name, r.linck_image
    FROM material_images AS m 
    JOIN stamping_materials AS s 
        ON m.id_stamping_materials = s.id_stamping_materials
    JOIN resources_images AS r
        ON r.id_resources_images = m.id_resources_images;