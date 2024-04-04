------------------------- EJERCICIO 1 ---------------------------------

create table buff_geom(id serial, geom geometry);
create table hurtos_buffer(id serial, contador int, geom geometry)



create or replace function buffer(lat float, lng float, rad int)
returns varchar as $$
declare
b geometry;
h geometry;
c int;
begin	
	delete from buff_geom;
	delete from hurtos_buffer;
	b = (select st_transform(st_buffer(st_transform(st_setsrid(st_makepoint(lng,lat),4326),3115),rad),4326));
	insert into buff_geom(geom) values(b);

	h= (select h_cerc.geom from (select hurtos.geom as geom, st_distance(st_setsrid(st_makepoint(lng,lat),4326),hurtos.geom) as hurto_cercano from hurtos where st_intersects(b, hurtos.geom) order by hurto_cercano asc limit 1)as h_cerc);
	c=(select count(hurtos.gid) from hurtos where st_intersects(b,hurtos.geom));
	insert into hurtos_buffer(contador, geom) values (c,h);
	
	return 'hecho';
end;
$$ language plpgsql;




------------------------------EJERCICIO 2 ------------------------------------------------------------

create table destino (id serial,x1 float,y1 float,x2 float,y2 float,geom1 geometry,geom2 geometry);

insert into destino (x1,y1,x2,y2,geom1,geom2) values (-76.55119,3.39091,-76.54501,3.45088, st_setsrid(st_makepoint(-76.55119,3.39091),4326),st_setsrid(st_makepoint(-76.54501,3.45088),4326));
insert into destino (x1,y1,x2,y2,geom1,geom2) values (-76.53117,3.37521,-76.516,3.48858, st_setsrid(st_makepoint(-76.53117,3.37521),4326),st_setsrid(st_makepoint(-76.516,3.48858),4326));
insert into destino (x1,y1,x2,y2,geom1,geom2) values (-76.46965,3.40496,-76.58624,3.46637, st_setsrid(st_makepoint(-76.46965,3.40496),4326),st_setsrid(st_makepoint(-76.58624,3.46637),4326));




