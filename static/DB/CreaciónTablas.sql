CREATE DATABASE Transporte;
USE Transporte;

CREATE TABLE cfgDepartamento
(
	Id_Departamento INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico del departamento',
	Nombre VARCHAR(60) NOT NULL COMMENT 'Nombre o descripción del departamento, Contabilidad, Administración,etc',
  Estatus CHAR(1) NOT NULL COMMENT 'Estatus del departamento 0 inactivo 1 activo',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);	

CREATE TABLE graEstado (
  Id_Estado int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Id de los estados',
  Nombre_Estado char(50) COLLATE utf8_unicode_ci DEFAULT NULL
);


CREATE TABLE cfgRoles
(
	Id_Rol INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador Unico del Rol' ,
   Nombre VARCHAR(60) NOT NULL COMMENT 'Nombre o descripción del rol ejemplo, Supervisor, Administrativo,Administrador',
   Estatus CHAR(1) NOT NULL COMMENT 'Estatus del rol 0 inactivo 1 activo',
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE cfgModulos
(
	Id_Modulo INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador Unico del Modulo' ,
   Nombre VARCHAR(60) NOT NULL COMMENT 'Nombre o descripción del modulo',
   Estatus CHAR(1) NOT NULL COMMENT 'Estatus del modulo 0 inactivo 1 activo',
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE cfgPermisos
(
	Id_Permiso INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador Unico del Permiso' ,
   Nombre VARCHAR(60) NOT NULL COMMENT 'Nombre o descripción del Permiso ejemplo Registrar, Eliminar, Consultar',
   Estatus CHAR(1) NOT NULL COMMENT 'Estatus del permiso 0 inactivo 1 activo',
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE cfgFolios_Doctos
(
	Id_Folio INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador Unico del Folio' ,
   Documento VARCHAR(60) NOT NULL COMMENT 'Nombre o descripción del Documento ejemplo Factura de Compra, Traspaso',
   FolioSiguiente INT NOT NULL DEFAULT 0,
   Serie VARCHAR(5) NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE cfgModulos_Permisos
(
  Id_Relacion INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador Unico del Usuario',
	Id_Modulo INT NOT NULL  COMMENT 'Identificador del Modulo' ,
	Id_Permiso INT NOT NULL  COMMENT 'Identificador del Permiso' ,
	Estatus CHAR(1) NOT NULL COMMENT 'Estatus del rol 0 inactivo 1 activo',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (Id_Modulo) REFERENCES cfgModulos(Id_Modulo) ON UPDATE CASCADE ON DELETE RESTRICT,
  FOREIGN KEY (Id_Permiso) REFERENCES cfgPermisos(Id_Permiso) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE cfgUsuarios
(
	 Id_Usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador Unico del Usuario',
    usuario varchar(30) NOT NULL COMMENT 'Nombre de usuario ',
    Password varchar(70) NOT NULL COMMENT 'Password del usuario',
    Nombre varchar(120) NOT NULL COMMENT 'Nombre completo del usuario',
    email VARCHAR(200) NOT NULL COMMENT 'Correo electronico del usuario',
    Activo ENUM('Activo','Inactivo') DEFAULT 'Activo' COMMENT 'Indica si esl usuario esta 1 activo o 0 inactivo',
    Id_Rol INT NOT NULL COMMENT 'Rol que desempeña el usuario',
    Id_Departamento INT NOT NULL COMMENT 'Departamento al cual pertenece el usuario',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,    
    FOREIGN KEY (Id_Rol) REFERENCES cfgRoles(Id_Rol) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (Id_Departamento) REFERENCES cfgDepartamento(Id_Departamento) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE cfgUsuarios_Permisos
(
	Id_Usuario INT NOT NULL COMMENT 'Identificador del usuario',
	Id_Modulo INT NOT NULL COMMENT 'Identificador del modeulo',
	Id_Permiso INT NOT NULL COMMENT 'Identificador del permiso',
   UNIQUE(Id_Usuario,Id_Modulo,Id_Permiso),
   FOREIGN KEY (Id_Usuario) REFERENCES cfgUsuarios(Id_Usuario) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Modulo) REFERENCES cfgModulos(Id_Modulo) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Permiso) REFERENCES cfgPermisos(Id_Permiso) ON UPDATE CASCADE ON DELETE RESTRICT	
);

CREATE TABLE graPropietarios
(
	 Id_Propietario INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador Unico del Propietario',
    Nombres varchar(60) NOT NULL COMMENT 'Nombre del Propietario',
    APaterno varchar(60) NULL COMMENT 'Apellido Paterno',
    AMaterno varchar(60) NULL COMMENT 'Apellido Materno Opcional',
    NombreCompleto varchar(180) AS (concat(Nombres,' ',APaterno,' ',AMaterno)) COMMENT 'Nombre completo concatenado columna calculada',
    RazonSocial VARCHAR(200) NULL COMMENT 'Razón social',
    RFC varchar(13) NULL COMMENT 'Registro Federal de Contribuyentes',
    Calle varchar(60) NULL COMMENT 'Nombre de la calle del domicilio del colaborador',
    Colonia varchar(60) NULL COMMENT 'Nombre de la colonia del domicilio del colaborador',
    CP varchar(5) NULL COMMENT 'Codigo Postal',
    Estado varchar(60) NULL COMMENT 'Nombre del estado del domicilio del colaborador',
    Celular varchar(20) NULL COMMENT 'Numero de linea celular del colaborador',
    Telefono varchar(20) null COMMENT 'Numero alternativo de linea celular',
    email varchar(60) NULL COMMENT 'Correo electronico del colaborador',
    Tipo_Persona ENUM('Fisica','Moral') NULL COMMENT 'Tipo de entidad',
    Estatus char(1) NULL COMMENT 'Estatus activo o inactivo del propietario',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    
);

CREATE TABLE graProveedores
(
	 Id_Proveedor INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador Unico del Proveedor',
    Nombres varchar(60) NOT NULL COMMENT 'Nombre del Proveedor',
    APaterno varchar(60) NULL COMMENT 'Apellido Proveedor',
    AMaterno varchar(60) NULL COMMENT 'Apellido Materno Opcional',
    NombreCompleto varchar(180) AS (concat(Nombres,' ',APaterno,' ',AMaterno)) COMMENT 'Nombre completo concatenado columna calculada',
    RazonSocial VARCHAR(200) NULL COMMENT 'Razón social',
    RFC varchar(13) NULL COMMENT 'Registro Federal de Contribuyentes',
    Calle varchar(60) NULL COMMENT 'Nombre de la calle del domicilio del colaborador',
    Colonia varchar(60) NULL COMMENT 'Nombre de la colonia del domicilio del colaborador',
    CP varchar(5) NULL COMMENT 'Codigo Postal',
    Estado varchar(60) NULL COMMENT 'Nombre del estado del domicilio del colaborador',
    Celular varchar(20) NULL COMMENT 'Numero de linea celular del colaborador',
    Telefono varchar(20) null COMMENT 'Numero alternativo de linea celular',
    email varchar(60) NULL COMMENT 'Correo electronico del colaborador',
    Tipo_Persona ENUM('Fisica','Moral') NULL COMMENT 'Tipo de entidad',
    Dias_Entrega INT NOT NULL DEFAULT 1 COMMENT 'Numero promedio de dias, para realizar sus entregas',
    Estatus char(1) NULL COMMENT 'Estatus activo o inactivo del proveedor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    
);

CREATE TABLE graClientes
(
	 Id_Cliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador Unico del Cliente',
    Nombres varchar(60) NOT NULL COMMENT 'Nombre del Cliente',
    APaterno varchar(60) NULL COMMENT 'Apellido Cliente',
    AMaterno varchar(60) NULL COMMENT 'Apellido Materno Opcional',
    NombreCompleto varchar(180) AS (concat(Nombres,' ',APaterno,' ',AMaterno)) COMMENT 'Nombre completo concatenado columna calculada',
    RazonSocial VARCHAR(200) NULL COMMENT 'Razón social',
    RFC varchar(13) NULL COMMENT 'Registro Federal de Contribuyentes',
    Calle varchar(60) NULL COMMENT 'Nombre de la calle del domicilio del colaborador',
    Colonia varchar(60) NULL COMMENT 'Nombre de la colonia del domicilio del colaborador',
    CP varchar(5) NULL COMMENT 'Codigo Postal',
    Estado varchar(60) NULL COMMENT 'Nombre del estado del domicilio del colaborador',
    Celular varchar(20) NULL COMMENT 'Numero de linea celular del colaborador',
    Telefono varchar(20) null COMMENT 'Numero alternativo de linea celular',
    email varchar(60) NULL COMMENT 'Correo electronico del colaborador',
    Tipo_Persona ENUM('Fisica','Moral') NULL COMMENT 'Tipo de entidad',
    Estatus char(1) NULL COMMENT 'Estatus activo o inactivo del cliente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    
);

CREATE TABLE almUbicaciones
(
	Id_Ubicacion INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico de la Ubicación',
	Nombre VARCHAR(60) NOT NULL COMMENT 'Nombre o descripción de la ubicación ejemplo, Pasillo A, Pasillo B, etc ',
  Estatus char(1) NULL COMMENT 'Estatus activo o inactivo de la ubicacion',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `almAlmacenes` (
  `Id_Almacen` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del Almacen',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción de la ubicación ejemplo, Principal, Secundario, Garantías etc ',
  `Estatus` char(1) NULL COMMENT 'Estatus activo o inactivo del almacen',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Almacen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `almTipos_Inventario` (
  `Id_Tipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del tipo de inventario',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción del tipo de inventario ejemplo, Refacciones, Consumibles, etc ',
  `Estatus` char(1) NULL COMMENT 'Estatus activo o inactivo del tipo de inventario',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `almTipos_Mov_Almacen` (
  `Id_TipoMov` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del tipo de movimiento',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción del tipo de movimiento ejemplo, Pieza Dañada, Ajuste al inventario, etc ',
  `Estatus` char(1) NULL COMMENT 'Estatus activo o inactivo del tipo de movimiento de almacen',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_TipoMov`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE almPartes
(
	Id_Parte INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico de la Parte',
	Codigo_Alterno VARCHAR(60) NULL COMMENT 'Codigo alterno o secundario de la parte',
	Descripcion VARCHAR(200) NOT NULL COMMENT 'Descripción de la parte',
	Ficha_Tecnica VARCHAR(500) NULL COMMENT 'Detalle, usos o especificaciones extendidas de la parte',
	Id_Tipo INT NOT NULL COMMENT 'Tipo de inventario al que pertenece la parte',
	Minimo INT NULL DEFAULT 0 COMMENT 'Mínimo de piezas en existencias de la parte',
	Maixmo INT NULL DEFAULT 0 COMMENT 'Máximo de piezas en existencias de la parte',
	Punto_Reorden INT NULL DEFAULT 0 COMMENT 'Punto para re ordernar piezas al proveedor',
	Costo_Reposicion DECIMAL(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Lo que cuesta reponer la pieza en el inventario',
	Ultimo_Costo DECIMAL(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Lo que cuesta reponer la pieza en el inventario',
	Fecha_UltimaCompra DATE NULL COMMENT 'Fecha de la ultima vez que se compro la pieza',
	UNIQUE(Codigo_Alterno),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   FOREIGN KEY (Id_Tipo) REFERENCES almTipos_Inventario(Id_Tipo) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE almPartes_Proveedores
(
	Id_Parte INT NOT NULL COMMENT 'Identificador de la Parte',
	Id_Proveedor INT NOT NULL COMMENT 'Identificador del proveedor',
	Codigo_Proveedor VARCHAR(60) NOT NULL COMMENT 'Codigo con el que identifica la pieza el proveedor',
	EsPrincipal ENUM('S','N') NOT NULL DEFAULT 'N' COMMENT 'Identifica si el proveedor es el principal para surtir la pieza',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   UNIQUE(Id_Parte,Id_Proveedor),
   FOREIGN KEY (Id_Parte) REFERENCES almPartes(Id_Parte) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Proveedor) REFERENCES graProveedores(Id_Proveedor) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE almExistencias_Almacen
(
	Id_Registro INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico del registro',
	Id_Parte INT NOT NULL COMMENT 'Identificador de la parte',
	Id_Almacen INT NOT NULL COMMENT 'Identificador del almacen',
	Existencia DECIMAL(12,2) NOT NULL COMMENT 'Existencia Actual de la pieza en el almacen',
	Costo_Promedio DECIMAL(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo promedio calculado de la pieza',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	UNIQUE(Id_Parte,Id_Almacen),
	FOREIGN KEY (Id_Parte) REFERENCES almPartes(Id_Parte) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Almacen) REFERENCES almAlmacenes(Id_Almacen) ON UPDATE CASCADE ON DELETE RESTRICT
);



CREATE TABLE almCardex_Partes
(
	Id_Registro INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico del registro',
	Id_Parte INT NOT NULL COMMENT 'Identificador de la parte',
	Id_Almacen INT NOT NULL COMMENT 'Identificador del almacen',
	Id_Documento INT NOT NULL COMMENT 'Identificador del documento que afecta al inventario',
	Descripcion VARCHAR(200) COMMENT 'Detalle del tipo de movimiento',
	Fecha DATETIME COMMENT 'Fecha y hora de la afectación al inventario',
	Exis_Anterior DECIMAL(12,2) NOT NULL DEFAULT 0 COMMENT 'Existencia anterior antes de la afectación',
	Entrada DECIMAL(12,2) NULL DEFAULT 0 COMMENT 'Cantidad de piezas que entran al inventario',
	Salida DECIMAL(12,2) NULL DEFAULT 0 COMMENT 'Cantidad de piezas que salen del inventario',	
	Exis_Final DECIMAL(12,2) AS (Exis_Anterior+Entrada-Salida) COMMENT 'Columna calculada con la existencia final',
	Costo DECIMAL(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo individual del documento que afecto al inventario',
	Costo_Promedio DECIMAL(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo promedio calculado al momento de la entrada',
	Id_Usuario INT NOT NULL COMMENT 'Usuario que realizo la afectación del documento',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (Id_Parte) REFERENCES almPartes(Id_Parte) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Almacen) REFERENCES almAlmacenes(Id_Almacen) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Usuario) REFERENCES cfgUsuarios(Id_Usuario) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE almPartes_Ubicaciones
(
	Id_Parte INT NOT NULL COMMENT 'Identificador de la parte',
	Id_Almacen INT NOT NULL COMMENT 'Identificador del almacen',
	UbiNivel1 INT NOT NULL COMMENT 'Identificador de la ubicación del nivel 1',
	UbiNivel2 INT NOT NULL COMMENT 'Identificador de la ubicación del nivel 2',
	UbiNivel3 INT NOT NULL COMMENT 'Identificador de la ubicación del nivel 3',	
	UbiNivel4 INT NOT NULL COMMENT 'Identificador de la ubicación del nivel 4',		
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (Id_Parte) REFERENCES almPartes(Id_Parte) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Almacen) REFERENCES almAlmacenes(Id_Almacen) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE almOrden_Compra
(
	Id_Orden INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico de la orden de compra',
	Folio INT NOT NULL COMMENT 'Folio consecutivo que le corresponde de acuerdo a la tabla de folios documentos',
	Serie VARCHAR(5) NULL COMMENT 'Serie asignada segun tabla de folios de documentos',
	Id_Proveedor INT NOT NULL COMMENT 'Identificador del proveedor a quien se le realiza la orden de compra',
	Id_Propietario INT NOT NULL COMMENT 'Identificador del propietario a quien se le asigna la orden de compra',
	Estado ENUM('PendAutorizar','SinSurtir','Parcialmente','Recibida','Cancelada') NOT NULL COMMENT 'Estado de la orden de compra',
	Id_UsuarioRegistro INT NOT NULL COMMENT 'Usuario que registro la orden de compra',
	Id_UsuarioAutoriza INT NULL COMMENT	'Usuario que autorizo la orden de compra para su pedido',
	Fecha_Autorizacion DATETIME NULL COMMENT 'Fecha y hora en que fue autorizada la orden de compra',
	Subtotal DECIMAL(19,2) NOT NULL COMMENT 'Sumatorio de costos de las partidas de la orden de compra',
	Impuestos DECIMAL(19,2) NOT NULL COMMENT 'Calculo de impuestos generados por el costo de las partidas',
	Total DECIMAL(19,2) AS (Subtotal+Impuestos) COMMENT 'Calculo de suma de subtotal mas impuestos',
	Observaciones TEXT NULL COMMENT 'Observaciones, notas o comentarios generales de la orden de compra',
	filePDF VARCHAR(300) NULL COMMENT 'Ruta de la carpeta donde se almacena el archivo digitalizado de la orden de compra',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (Id_Proveedor) REFERENCES graProveedores(Id_Proveedor) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Propietario) REFERENCES graPropietarios(Id_Propietario) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_UsuarioRegistro) REFERENCES cfgUsuarios(Id_Usuario) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_UsuarioAutoriza) REFERENCES cfgUsuarios(Id_Usuario) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE almDetalle_Orden_Compra
(
	Id_Registro INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico del registro',
	Id_Orden INT NOT NULL COMMENT 'Identificador de la orden de compra',
	Id_Parte INT NOT NULL COMMENT 'Identificador de la parte',
	Cantidad DECIMAL(12,2) NOT NULL DEFAULT 1 COMMENT 'Cantidad de Piezas solicitadas en la orden de compra',
	Costo DECIMAL(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo de la pieza',
	Costo_Total DECIMAL(19,2) AS (Cantidad*Costo) COMMENT 'Costo total de la piezas ordenadas',
	Cantidad_Surtida DECIMAL(12,2) NULL DEFAULT 0 COMMENT 'Cantidad de Piezas que se han surtido en las facturas de compra',
	Cantidad_Pendiente DECIMAL(12,2) AS (Cantidad-Cantidad_Surtida) COMMENT 'Cantidad de piezas pendiente de Surtir',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   UNIQUE(Id_Orden,Id_Parte),
	FOREIGN KEY (Id_Orden) REFERENCES almOrden_Compra(Id_Orden) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY (Id_Parte) REFERENCES almPartes(Id_Parte) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE almFactura_Compra
(
	Id_FactCompra INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico del registro de la factura de compra',
	Factura_Proveedor VARCHAR(20) NOT NULL COMMENT 'Numero de factura del proveedor',
	Fecha_Documento DATE NOT NULL COMMENT 'Fecha del documento del proveedor',
	Id_Proveedor INT NOT NULL COMMENT 'Identificador del proveedor a quien se le realizo la factura de compra',
	Id_Propietario INT NOT NULL COMMENT 'Identificador del propietario a quien se le asigna la factura de compra',
	Id_Almacen INT NOT NULL COMMENT 'Identificador del almacen al cual entraran las piezas',
	Estado ENUM('SinAplicar','Aplicada','Cancelada') NOT NULL COMMENT 'Estado de la factura de compra',
	Id_UsuarioRegistro INT NOT NULL COMMENT 'Usuario que registro la orden de compra',
	Subtotal DECIMAL(19,2) NOT NULL COMMENT 'Sumatorio de costos de las partidas de la orden de compra',
	Impuestos DECIMAL(19,2) NOT NULL COMMENT 'Calculo de impuestos generados por el costo de las partidas',
	Total DECIMAL(19,2) AS (Subtotal+Impuestos) COMMENT 'Calculo de suma de subtotal mas impuestos',
	Saldo DECIMAL(19,2) NULL DEFAULT 0 COMMENT 'Saldo pendiente de pago de la factura',
	Observaciones TEXT NULL COMMENT 'Observaciones, notas o comentarios generales de la orden de compra',
	filePDF VARCHAR(300) NULL COMMENT 'Ruta de la carpeta donde se almacena el archivo PDF del CFDI',
	fileXML VARCHAR(300) NULL COMMENT 'Ruta de la carpeta donde se almacena el archivo XML del CFDI',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   FOREIGN KEY (Id_Proveedor) REFERENCES graProveedores(Id_Proveedor) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Propietario) REFERENCES graPropietarios(Id_Propietario) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Almacen) REFERENCES almAlmacenes(Id_Almacen) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_UsuarioRegistro) REFERENCES cfgUsuarios(Id_Usuario) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE almDetalle_Factura_Compra
(
	Id_Registro INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico del registro',
	Id_FactCompra INT NOT NULL COMMENT 'Identificador de la Factura de Compra de origen',
	Id_Registro_OrdCompra INT NOT NULL COMMENT 'Identificador de la partida de la orden de compra',
	Id_Parte INT NOT NULL COMMENT 'Identificador de la Parte',
	Cantidad DECIMAL(12,2) NOT NULL DEFAULT 0 COMMENT 'Cantidad de piezas compradas',
	Costo DECIMAL(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo de la pieza comprada',
	Costotal DECIMAL(19,2) AS (Cantidad*Costo) COMMENT 'Costo total de pizas compradas',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	UNIQUE(Id_FactCompra,Id_Registro_OrdCompra,Id_Parte),
   FOREIGN KEY (Id_FactCompra) REFERENCES almFactura_Compra(Id_FactCompra) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Registro_OrdCompra) REFERENCES almDetalle_Orden_Compra(Id_Registro) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY (Id_Parte) REFERENCES almPartes(Id_Parte) ON UPDATE CASCADE ON DELETE RESTRICT   
);

CREATE TABLE almAjuste_Almacen
(
	Id_Ajuste INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico del ajuste',
	Folio INT NOT NULL COMMENT 'Folio asignado consecutivo de la tabla de folios de documentos',
	Serie VARCHAR(5) NULL COMMENT 'Serie asignado de la tabla de folios de documentos',
	Tipo ENUM('Entrada','Salida') NOT NULL COMMENT 'Tipo de Ajuste de entrada o salida al inventario',
	Id_TipoMov INT NOT NULL COMMENT 'Tipo de Movimiento',
	Id_Almacen INT NOT NULL COMMENT 'Identificador del almacen al cual entraran las piezas',
	Estado ENUM('SinAplicar','Aplicado','Cancelado') NOT NULL COMMENT 'Estado del ajuste',
	Costotal DECIMAL(19,2) NOT NULL DEFAULT 0 COMMENT 'Sumatorio de los costos de las partidas del ajuste',
	Id_UsuarioRegistro INT NOT NULL COMMENT 'Identificador del usuario que registro el ajuste',
	Id_UsuarioAutoriza INT NULL COMMENT 'Identificador del usuario que autorizo el ajuste',
	Fecha_Autoriza DATETIME NULL COMMENT 'Fecha en que fue autorizado el ajuste',
	Observaciones TEXT NULL COMMENT 'Detalles, Notas, Observaciones del ajuste',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY (Id_TipoMov) REFERENCES almTipos_Mov_Almacen(Id_TipoMov) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_Almacen) REFERENCES almAlmacenes(Id_Almacen) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_UsuarioRegistro) REFERENCES cfgUsuarios(Id_Usuario) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_UsuarioAutoriza) REFERENCES cfgUsuarios(Id_Usuario) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE almDetalle_Ajustes
(
	Id_Registro INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico del registro',
	Id_Ajuste INT NOT NULL COMMENT 'Identificador del ajuste',
	Id_Parte INT NOT NULL COMMENT 'Identificador de la parte',
	Cantidad DECIMAL(12,2) NOT NULL DEFAULT 1 COMMENT 'Cantidad de piezas a ajustar',
	Costo DECIMAL(19,2) NOT NULL DEFAULT 0 COMMENT 'Costo de la pieza',
	Costototal DECIMAL(19,2) AS (Cantidad*Costo) COMMENT 'Costotal de las piezas por la cantidad',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   FOREIGN KEY (Id_Ajuste) REFERENCES almAjuste_Almacen(Id_Ajuste) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY (Id_Parte) REFERENCES almPartes(Id_Parte) ON UPDATE CASCADE ON DELETE RESTRICT      
);

CREATE TABLE almTraspaso
(
	Id_Traspaso INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico del traspaso',
	Folio INT NOT NULL COMMENT 'Folio asignado consecutivo de la tabla de folios de documentos',
	Serie VARCHAR(5) NULL COMMENT 'Serie asignado de la tabla de folios de documentos',
	Id_AlmacenOri INT NOT NULL COMMENT 'Identificador del Almacen Origen',
	Id_AlmacenDes INT NOT NULL COMMENT 'Identificador del Almacen Destino',
	Costotal DECIMAL(19,2) NOT NULL DEFAULT 0 COMMENT 'Sumatorio de los costos de las partidas del traspaso',
	Observaciones TEXT NULL COMMENT 'Detalles, Notas, Observaciones del traspaso',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   FOREIGN KEY (Id_AlmacenOri) REFERENCES almAlmacenes(Id_Almacen) ON UPDATE CASCADE ON DELETE RESTRICT,
   FOREIGN KEY (Id_AlmacenDes) REFERENCES almAlmacenes(Id_Almacen) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE almDetalle_Traspaso
(
	Id_Registro INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico del registro',
	Id_Traspaso INT NOT NULL COMMENT 'Identificador unico del traspaso',
	Id_Parte INT NOT NULL COMMENT 'Identificador de la parte',
	Cantidad DECIMAL(12,2) NOT NULL DEFAULT 1 COMMENT 'Cantidad de piezas a traspasar',
	Costo DECIMAL(19,2) NOT NULL DEFAULT 0 COMMENT 'Costo de la pieza',
	Costototal DECIMAL(19,2) AS (Cantidad*Costo) COMMENT 'Costotal de las piezas por la cantidad',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   FOREIGN KEY (Id_Traspaso) REFERENCES almTraspaso(Id_Traspaso) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY (Id_Parte) REFERENCES almPartes(Id_Parte) ON UPDATE CASCADE ON DELETE RESTRICT      
);
