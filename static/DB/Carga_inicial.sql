-- INSERT DE MODULOS
INSERT INTO cfgDepartamento(`Id_Departamento`,`Nombre`,`Estatus`,`created_at`,`updated_at`) VALUES
	(1,'Contabilidad',1,NOW(),NOW()),
	(2,'Sistemas',1,NOW(),NOW()),
	(3,'Mantenimiento',1,NOW(),NOW()),
	(4,'Administracion',1,NOW(),NOW()),
	(5,'Almacen',1,NOW(),NOW());

-- INSERT DE LOS ROLES
INSERT INTO cfgRoles(`Id_Rol`,`Nombre`,`Estatus`,`created_at`,`updated_at`) VALUES
	(1,'Administrador',1,NOW(),NOW()),
	(2,'Operativo',1,NOW(),NOW()),
	(3,'Gerente',1,NOW(),NOW()),
	(4,'Administrativo',1,NOW(),NOW());

-- INSERT DE PERMISOS
INSERT INTO cfgPermisos(`Id_Permiso`,`Nombre`,`Estatus`,`created_at`,`updated_at`) VALUES
	(1,'Registrar',1,NOW(),NOW()),
	(2,'Eliminar',1,NOW(),NOW()),
	(3,'Modificar',1,NOW(),NOW()),
	(4,'Consulta',1,NOW(),NOW()),
	(5,'Autorizar',1,NOW(),NOW());

-- INSERT DE MODULOS
INSERT INTO cfgModulos(`Id_Modulo`,`Nombre`,`Estatus`,`created_at`,`updated_at`) VALUES
	(1,'Ordenes de compra',1,NOW(),NOW()),
	(2,'Facturas de compra',1,NOW(),NOW()),
	(3,'Movimientos de almacen',1,NOW(),NOW()),
	(4,'Traspasos',1,NOW(),NOW()),
	(5,'Requesiciones de taller',1,NOW(),NOW());


INSERT INTO `graEstado` (`Id_Estado`, `Nombre_Estado`) VALUES
(1, 'Aguascalientes'),
(2, 'Baja California'),
(3, 'Baja California Sur'),
(4, 'Campeche'),
(5, 'Chiapas'),
(6, 'Chihuahua'),
(7, 'Ciudad de México'),
(8, 'Coahuila'),
(9, 'Colima'),
(10, 'Durango'),
(11, 'Guanajuato'),
(12, 'Guerrero'),
(13, 'Hidalgo'),
(14, 'Jalisco'),
(15, 'México'),
(16, 'Michoacán'),
(17, 'Morelos'),
(18, 'Nayarit'),
(19, 'Nuevo León'),
(20, 'Oaxaca'),
(21, 'Puebla'),
(22, 'Querétaro'),
(23, 'Quintana Roo'),
(24, 'San Luis Potosí'),
(25, 'Sinaloa'),
(26, 'Sonora'),
(27, 'Tabasco'),
(28, 'Tamaulipas'),
(29, 'Tlaxcala'),
(30, 'Veracruz'),
(31, 'Yucatán'),
(32, 'Zacatecas');


INSERT INTO almUbicaciones(`Id_Ubicacion`,`Nombre`,`Estatus`,`created_at`,`updated_at`) VALUES 
	(1,'Pasillo A',1,NOW(),NOW()),
	(2,'Pasillo B',1,NOW(),NOW()),
	(3,'Pasillo C',1,NOW(),NOW()),
	(4,'Pasillo Principal',1,NOW(),NOW()),
	(5,'Pasillo Secundario',1,NOW(),NOW());

INSERT INTO almTipos_Inventario(`Id_Tipo`,`Nombre`,`Estatus`,`created_at`,`updated_at`) VALUES 
	(1,'Refacciones',1,NOW(),NOW()),
	(2,'Hojalateria',1,NOW(),NOW()),
	(3,'Consumibles',1,NOW(),NOW()),
	(4,'Soldadura',1,NOW(),NOW()),
	(5,'Otros',1,NOW(),NOW());

INSERT INTO almAlmacenes(`Id_Almacen`,`Nombre`,`Estatus`,`created_at`,`updated_at`) VALUES 
	(1,'Principal',1,NOW(),NOW()),
	(2,'Hojalateria',1,NOW(),NOW()),
	(3,'Secundario',1,NOW(),NOW()),
	(4,'Primer Piso',1,NOW(),NOW()),
	(5,'Segundo Piso',1,NOW(),NOW());

INSERT INTO almTipos_Mov_Almacen(`Id_TipoMov`,`Nombre`,`Estatus`,`created_at`,`updated_at`) VALUES 
	(1,'Producto dañado',1,NOW(),NOW()),
	(2,'Obsequio de proveedor',1,NOW(),NOW()),
	(3,'Inventario Fisico',1,NOW(),NOW()),
	(4,'Prestamo',1,NOW(),NOW()),
	(5,'Devolucion',1,NOW(),NOW());


INSERT INTO cfgModulos_Permisos(`Id_Relacion`,`Id_Modulo`,`Id_Permiso`,`Estatus`,`created_at`,`updated_at`) VALUES 
	(1,1,1,1,NOW(),NOW()),
	(2,1,2,1,NOW(),NOW()),
	(3,1,3,1,NOW(),NOW()),
	(4,1,4,1,NOW(),NOW()),
	(5,1,5,1,NOW(),NOW()),
	(6,2,1,1,NOW(),NOW()),
	(7,2,2,1,NOW(),NOW()),
	(8,2,3,1,NOW(),NOW()),
	(9,2,4,1,NOW(),NOW()),
	(10,2,5,1,NOW(),NOW());


INSERT INTO `graProveedores` VALUES 
	(1,'RICARDO','RAMOS','GOMEZ','RICARDO RAMOS GOMEZ','Norte Sur Repuestos S.A. de C.V.','NSR981227NKSS','Epigmenio González 1009','Desarrollo Montaña 2000','76150','Querétaro','76150 ','442 217 0217','ricardo.gomez@norsur.com.mx','Moral',10,'1','2019-09-24 21:56:48','2019-09-24 21:57:07'),
	(2,'Saul','Trejo','Ramos','Saul Trejo Ramos','Comercial de Autopartes sa de cv','COME8956878NK',' Mariana Rodríguez de Lazarín #206','zona dos extendida, Corregidora','76070','Querétaro','44237656','','saul@gmail.com','Fisica',5,'1','2019-09-26 16:41:45','2019-09-26 16:47:00'),
	(3,'Rosario','','','Rosario  ','Alces Accesorios SA DE CV','ALCA8962578JD','Calle Ezequiel Montes 194A','El Carrizal','76030','Querétaro','442 242 4729','','ALCES1@PRODIGY.NET.MX','Fisica',7,'1','2019-09-26 16:46:37','2019-09-26 16:46:37'),
	(4,'Trejo ','','samuel','samuel Trejo','Alces Accesorios centro SA DE CV','ALC8962578JD','Calle privada Montes 194A','El Carrizal','76116','Querétaro','442 242 4729','','ALCES1M@PRODIGY.NET.MX','Fisica',8,'1','2019-09-26 16:46:37','2019-09-26 16:46:37');

INSERT INTO `almPartes` VALUES 
	(1,'A444','Filtro de aire KW12345 - H','Características Clave\nProtector contra altos cambios de voltaje\nFuncionamiento Silencioso\nAire limpio y puro (Filtro Multi Protección 3M)\nEnfriamiento Rápido con su función Jet Cool',2,10,50,15,5000.00,4500.00,'2019-09-16','2019-09-25 18:56:33','2019-09-25 18:56:33'),
	(2,'B444','Gato de tijera hidraulico','gato de tijera hidraulico nuevo, para 1.5 ton. incluye llave para birlo y gancho para arrastre',5,1,50,2,1200.00,1000.00,'2019-08-01','2019-09-26 16:30:27','2019-09-26 16:30:27'),
	(3,'C444','Calaveras vw Caribe','calaveras originales para caribe',1,1,20,4,2000.00,1500.00,'2019-08-20','2019-09-26 16:35:11','2019-09-26 16:35:11'),
	(4,'D444','Rotulas Bieletas Bujes Cacahuates Y Brazo Tsuru Gs 92-17 Hid','2 rotulas, 2 bieletas, 2 terminales, 4 bujes de horquilla, 2 cacahuates, y 4 brazos paralelos de suspension trasera para nissan tsuru gs 16v 92-17',1,1,20,5,1890.00,1200.00,'2019-07-17','2019-09-26 16:38:20','2019-09-26 16:38:20');

INSERT INTO `cfgUsuarios` VALUES 
	(1,'santi','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f','Santiago','santiago.gp@outlook.com','Activo',1,2,'2019-10-08 22:44:21','2019-10-08 22:44:21'),
	(2,'noe','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f','Noe Ramos','noe.ramlop93@gmail.com','Activo',2,2,'2019-10-08 22:44:21','2019-10-08 22:44:21'),
	(3,'Saul_1','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f','Saul Trejo Ramos','saul@gmail.com','Activo',3,3,'2019-10-09 18:01:23','2019-10-09 18:01:23'),
	(4,'basurto_2','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f','Basurto Herrera Trejo','basurto@yahoo.com','Activo',4,3,'2019-10-09 18:19:51','2019-10-09 18:19:51'),
	(5,'Marco','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f','Marco Polo Quintana Trejo','marcopolo@gmail.com','Activo',1,2,'2019-10-09 18:21:54','2019-10-09 18:21:54'),
	(6,'Ely','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f','Elizabet Trejo Quintana','chaparritaEly@gmail.com','Activo',2,2,'2019-10-09 18:23:53','2019-10-09 18:23:53');


INSERT INTO `graPropietarios` VALUES 
	(1,'Juan','Ramirez','Esmaide','Juan Ramirez Esmaide','SOLICITUD sa de cv','RAEJ872382HGS','Priv Humedad','El Rocio','7515','Queretaro','4423784653','4423784653','juanram@gmail.com','Moral','1','2019-10-14 12:11:08','2019-10-14 12:11:08');

INSERT INTO `almOrden_Compra` VALUES 
	(1,1132123,'S',2,1,'PendAutorizar',2,NULL,NULL,5993.00,958.00,6951.00,'PRIMERA ORDEN DE COMRPA PARA GUARADR',NULL,'2019-10-14 12:43:43','2019-10-14 12:43:43'),
	(2,1231231,'A',1,1,'PendAutorizar',2,NULL,NULL,430.00,68.00,498.00,'Segunda captura de partes',NULL,'2019-10-14 17:02:45','2019-10-14 17:02:45'),
	(3,210001,'A',1,1,'PendAutorizar',2,NULL,NULL,430.00,68.00,498.00,'Tercera captura de partes',NULL,'2019-10-14 17:12:45','2019-10-14 17:12:45'),
	(4,121374546,'B',1,1,'PendAutorizar',2,NULL,NULL,430.00,68.00,498.00,'Tercera captura de partes',NULL,'2019-10-14 17:13:48','2019-10-14 17:13:48'),
	(5,23738,'C',1,1,'PendAutorizar',2,NULL,NULL,430.00,68.00,498.00,'Tercera captura de partes',NULL,'2019-10-14 17:14:19','2019-10-14 17:14:19'),
	(6,2323,'C',1,1,'PendAutorizar',2,NULL,NULL,430.00,68.00,498.00,'Tercera captura de partes',NULL,'2019-10-14 17:15:52','2019-10-14 17:15:52'),
	(7,2335,'C',1,1,'PendAutorizar',2,NULL,NULL,430.00,68.00,498.00,'Tercera captura de partes',NULL,'2019-10-14 17:16:20','2019-10-14 17:16:20'),
	(8,2336,'C',1,1,'PendAutorizar',2,NULL,NULL,430.00,68.00,498.00,'Tercera captura de partes',NULL,'2019-10-14 17:21:20','2019-10-14 17:21:20'),
	(9,2337,'D',1,1,'PendAutorizar',2,NULL,NULL,430.00,68.00,498.00,'Tercera captura de partes',NULL,'2019-10-14 17:22:05','2019-10-14 17:22:05');

INSERT INTO `almDetalle_Orden_Compra` VALUES 
	(1,9,4,1.00,280.00,280.00,0.00,1.00,'2019-10-14 17:22:05','2019-10-14 17:22:05'),
	(2,9,1,1.00,150.00,150.00,0.00,1.00,'2019-10-14 17:22:05','2019-10-14 17:22:05');

-- comando para respoaldo mysqldump -u username -p database_name > data-dump.sql

INSERT INTO `almFactura_Compra` VALUES 
	(1,'AAA10002',now(),3,1,1,'SinAplicar',2,430.00,68.00,498.00,0.0,'Orden Completa','','', now(),now());

INSERT INTO almDetalle_Factura_Compra(`Id_Registro`,`Id_FactCompra`,`Id_Registro_OrdCompra`,`Id_Parte`,`Cantidad`,`Costo`,`Costotal`,`created_at`,`updated_at`) VALUES
	(1,1,2,1,1,150,150,now(),now()),
	(2,1,1,1,1,280,280,now(),now());


INSERT INTO `almcardex_partes` VALUES
	(1,2,1,1,'Primeras piezas',now(),0,1,0,1,150,150,2,now(),now()),
	(2,1,1,1,'Primeras piezas',now(),0,1,0,1,250,250,2,now(),now());

