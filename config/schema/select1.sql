select 
	route.from `code_from`,
    route.to `code_to`,
    from_objects.city_name `city_from`,
    to_objects.city_name `city_to`,
    from_objects.airport_name `airport_from`,    
    to_objects.airport_name `airport_to`
from
	route
    left join airobjects `from_objects`
		on from_objects.code = route.`from`
        AND from_objects.type = route.from_type
    left join airobjects `to_objects`
		on to_objects.code = route.`to`
        AND to_objects.type = route.to_type  