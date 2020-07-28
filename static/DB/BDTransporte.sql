CREATE DATABASE ALMACEN;
USE ALMACEN;

-- --------------------------------------------------------
-- Host:                         192.168.1.90
-- Versión del servidor:         10.3.17-MariaDB-1:10.3.17+maria~bionic-log - mariadb.org binary distribution
-- SO del servidor:              debian-linux-gnu
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para Transporte
CREATE DATABASE IF NOT EXISTS `Transporte` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Transporte`;

-- Volcando estructura para tabla Transporte.almAjuste_Almacen
CREATE TABLE IF NOT EXISTS `almAjuste_Almacen` (
  `Id_Ajuste` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del ajuste',
  `Folio` int(11) NOT NULL COMMENT 'Folio asignado consecutivo de la tabla de folios de documentos',
  `Serie` varchar(5) DEFAULT NULL COMMENT 'Serie asignado de la tabla de folios de documentos',
  `Tipo` enum('Entrada','Salida') NOT NULL COMMENT 'Tipo de Ajuste de entrada o salida al inventario',
  `Id_TipoMov` int(11) NOT NULL COMMENT 'Tipo de Movimiento',
  `Estado` enum('SinAplicar','Aplicado','Cancelado') NOT NULL COMMENT 'Estado del ajuste',
  `Costotal` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Sumatorio de los costos de las partidas del ajuste',
  `Id_UsuarioRegistro` int(11) NOT NULL COMMENT 'Identificador del usuario que registro el ajuste',
  `Id_UsuarioAutoriza` int(11) DEFAULT NULL COMMENT 'Identificador del usuario que autorizo el ajuste',
  `Fecha_Autoriza` datetime DEFAULT NULL COMMENT 'Fecha en que fue autorizado el ajuste',
  `Observaciones` text DEFAULT NULL COMMENT 'Detalles, Notas, Observaciones del ajuste',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Ajuste`),
  KEY `Id_TipoMov` (`Id_TipoMov`),
  KEY `Id_UsuarioRegistro` (`Id_UsuarioRegistro`),
  KEY `Id_UsuarioAutoriza` (`Id_UsuarioAutoriza`),
  CONSTRAINT `almAjuste_Almacen_ibfk_1` FOREIGN KEY (`Id_TipoMov`) REFERENCES `almTipos_Mov_Almacen` (`Id_TipoMov`) ON UPDATE CASCADE,
  CONSTRAINT `almAjuste_Almacen_ibfk_2` FOREIGN KEY (`Id_UsuarioRegistro`) REFERENCES `cfgUsuarios` (`Id_Usuario`) ON UPDATE CASCADE,
  CONSTRAINT `almAjuste_Almacen_ibfk_3` FOREIGN KEY (`Id_UsuarioAutoriza`) REFERENCES `cfgUsuarios` (`Id_Usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almAjuste_Almacen: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almAjuste_Almacen` DISABLE KEYS */;
/*!40000 ALTER TABLE `almAjuste_Almacen` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almAlmacenes
CREATE TABLE IF NOT EXISTS `almAlmacenes` (
  `Id_Almacen` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del Almacen',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción de la ubicación ejemplo, Principal, Secundario, Garantías etc ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Almacen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almAlmacenes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almAlmacenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `almAlmacenes` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almCardex_Partes
CREATE TABLE IF NOT EXISTS `almCardex_Partes` (
  `Id_Registro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro',
  `Id_Parte` int(11) NOT NULL COMMENT 'Identificador de la parte',
  `Id_Almacen` int(11) NOT NULL COMMENT 'Identificador del almacen',
  `Id_Documento` int(11) NOT NULL COMMENT 'Identificador del documento que afecta al inventario',
  `Descripcion` varchar(200) DEFAULT NULL COMMENT 'Detalle del tipo de movimiento',
  `Fecha` datetime DEFAULT NULL COMMENT 'Fecha y hora de la afectación al inventario',
  `Exis_Anterior` decimal(12,2) NOT NULL DEFAULT 0.00 COMMENT 'Existencia anterior antes de la afectación',
  `Entrada` decimal(12,2) DEFAULT 0.00 COMMENT 'Cantidad de piezas que entran al inventario',
  `Salida` decimal(12,2) DEFAULT 0.00 COMMENT 'Cantidad de piezas que salen del inventario',
  `Exis_Final` decimal(12,2) GENERATED ALWAYS AS (`Exis_Anterior` + `Entrada` - `Salida`) VIRTUAL COMMENT 'Columna calculada con la existencia final',
  `Costo` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo individual del documento que afecto al inventario',
  `Costo_Promedio` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo promedio calculado al momento de la entrada',
  `Id_Usuario` int(11) NOT NULL COMMENT 'Usuario que realizo la afectación del documento',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Registro`),
  KEY `Id_Parte` (`Id_Parte`),
  KEY `Id_Almacen` (`Id_Almacen`),
  KEY `Id_Usuario` (`Id_Usuario`),
  CONSTRAINT `almCardex_Partes_ibfk_1` FOREIGN KEY (`Id_Parte`) REFERENCES `almPartes` (`Id_Parte`) ON UPDATE CASCADE,
  CONSTRAINT `almCardex_Partes_ibfk_2` FOREIGN KEY (`Id_Almacen`) REFERENCES `almAlmacenes` (`Id_Almacen`) ON UPDATE CASCADE,
  CONSTRAINT `almCardex_Partes_ibfk_3` FOREIGN KEY (`Id_Usuario`) REFERENCES `cfgUsuarios` (`Id_Usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almCardex_Partes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almCardex_Partes` DISABLE KEYS */;
/*!40000 ALTER TABLE `almCardex_Partes` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almDetalle_Ajustes
CREATE TABLE IF NOT EXISTS `almDetalle_Ajustes` (
  `Id_Registro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro',
  `Id_Ajuste` int(11) NOT NULL COMMENT 'Identificador del ajuste',
  `Id_Parte` int(11) NOT NULL COMMENT 'Identificador de la parte',
  `Cantidad` decimal(12,2) NOT NULL DEFAULT 1.00 COMMENT 'Cantidad de piezas a ajustar',
  `Costo` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo de la pieza',
  `Costototal` decimal(19,2) GENERATED ALWAYS AS (`Cantidad` * `Costo`) VIRTUAL COMMENT 'Costotal de las piezas por la cantidad',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Registro`),
  KEY `Id_Ajuste` (`Id_Ajuste`),
  KEY `Id_Parte` (`Id_Parte`),
  CONSTRAINT `almDetalle_Ajustes_ibfk_1` FOREIGN KEY (`Id_Ajuste`) REFERENCES `almAjuste_Almacen` (`Id_Ajuste`) ON UPDATE CASCADE,
  CONSTRAINT `almDetalle_Ajustes_ibfk_2` FOREIGN KEY (`Id_Parte`) REFERENCES `almPartes` (`Id_Parte`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almDetalle_Ajustes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almDetalle_Ajustes` DISABLE KEYS */;
/*!40000 ALTER TABLE `almDetalle_Ajustes` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almDetalle_Factura_Compra
CREATE TABLE IF NOT EXISTS `almDetalle_Factura_Compra` (
  `Id_Registro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro',
  `Id_FactCompra` int(11) NOT NULL COMMENT 'Identificador de la Factura de Compra de origen',
  `Id_Registro_OrdCompra` int(11) NOT NULL COMMENT 'Identificador de la partida de la orden de compra',
  `Id_Parte` int(11) NOT NULL COMMENT 'Identificador de la Parte',
  `Cantidad` decimal(12,2) NOT NULL DEFAULT 0.00 COMMENT 'Cantidad de piezas compradas',
  `Costo` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo de la pieza comprada',
  `Costotal` decimal(19,2) GENERATED ALWAYS AS (`Cantidad` * `Costo`) VIRTUAL COMMENT 'Costo total de pizas compradas',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Registro`),
  UNIQUE KEY `Id_FactCompra` (`Id_FactCompra`,`Id_Registro_OrdCompra`,`Id_Parte`),
  KEY `Id_Registro_OrdCompra` (`Id_Registro_OrdCompra`),
  KEY `Id_Parte` (`Id_Parte`),
  CONSTRAINT `almDetalle_Factura_Compra_ibfk_1` FOREIGN KEY (`Id_FactCompra`) REFERENCES `almFactura_Compra` (`Id_FactCompra`) ON UPDATE CASCADE,
  CONSTRAINT `almDetalle_Factura_Compra_ibfk_2` FOREIGN KEY (`Id_Registro_OrdCompra`) REFERENCES `almDetalle_Orden_Compra` (`Id_Registro`) ON UPDATE CASCADE,
  CONSTRAINT `almDetalle_Factura_Compra_ibfk_3` FOREIGN KEY (`Id_Parte`) REFERENCES `almPartes` (`Id_Parte`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almDetalle_Factura_Compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almDetalle_Factura_Compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `almDetalle_Factura_Compra` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almDetalle_Orden_Compra
CREATE TABLE IF NOT EXISTS `almDetalle_Orden_Compra` (
  `Id_Registro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro',
  `Id_Orden` int(11) NOT NULL COMMENT 'Identificador de la orden de compra',
  `Id_Parte` int(11) NOT NULL COMMENT 'Identificador de la parte',
  `Cantidad` decimal(12,2) NOT NULL DEFAULT 1.00 COMMENT 'Cantidad de Piezas solicitadas en la orden de compra',
  `Costo` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo de la pieza',
  `Costo_Total` decimal(19,2) GENERATED ALWAYS AS (`Cantidad` * `Costo`) VIRTUAL COMMENT 'Costo total de la piezas ordenadas',
  `Cantidad_Surtida` decimal(12,2) DEFAULT 0.00 COMMENT 'Cantidad de Piezas que se han surtido en las facturas de compra',
  `Cantidad_Pendiente` decimal(12,2) GENERATED ALWAYS AS (`Cantidad` - `Cantidad_Surtida`) VIRTUAL COMMENT 'Cantidad de piezas pendiente de Surtir',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Registro`),
  UNIQUE KEY `Id_Orden` (`Id_Orden`,`Id_Parte`),
  KEY `Id_Parte` (`Id_Parte`),
  CONSTRAINT `almDetalle_Orden_Compra_ibfk_1` FOREIGN KEY (`Id_Orden`) REFERENCES `almOrden_Compra` (`Id_Orden`) ON UPDATE CASCADE,
  CONSTRAINT `almDetalle_Orden_Compra_ibfk_2` FOREIGN KEY (`Id_Parte`) REFERENCES `almPartes` (`Id_Parte`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almDetalle_Orden_Compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almDetalle_Orden_Compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `almDetalle_Orden_Compra` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almDetalle_Traspaso
CREATE TABLE IF NOT EXISTS `almDetalle_Traspaso` (
  `Id_Registro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro',
  `Id_Traspaso` int(11) NOT NULL COMMENT 'Identificador unico del traspaso',
  `Id_Parte` int(11) NOT NULL COMMENT 'Identificador de la parte',
  `Cantidad` decimal(12,2) NOT NULL DEFAULT 1.00 COMMENT 'Cantidad de piezas a traspasar',
  `Costo` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo de la pieza',
  `Costototal` decimal(19,2) GENERATED ALWAYS AS (`Cantidad` * `Costo`) VIRTUAL COMMENT 'Costotal de las piezas por la cantidad',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Registro`),
  KEY `Id_Traspaso` (`Id_Traspaso`),
  KEY `Id_Parte` (`Id_Parte`),
  CONSTRAINT `almDetalle_Traspaso_ibfk_1` FOREIGN KEY (`Id_Traspaso`) REFERENCES `almTraspaso` (`Id_Traspaso`) ON UPDATE CASCADE,
  CONSTRAINT `almDetalle_Traspaso_ibfk_2` FOREIGN KEY (`Id_Parte`) REFERENCES `almPartes` (`Id_Parte`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almDetalle_Traspaso: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almDetalle_Traspaso` DISABLE KEYS */;
/*!40000 ALTER TABLE `almDetalle_Traspaso` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almExistencias_Almacen
CREATE TABLE IF NOT EXISTS `almExistencias_Almacen` (
  `Id_Registro` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro',
  `Id_Parte` int(11) NOT NULL COMMENT 'Identificador de la parte',
  `Id_Almacen` int(11) NOT NULL COMMENT 'Identificador del almacen',
  `Existencia` decimal(12,2) NOT NULL COMMENT 'Existencia Actual de la pieza en el almacen',
  `Costo_Promedio` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Costo promedio calculado de la pieza',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Registro`),
  UNIQUE KEY `Id_Parte` (`Id_Parte`,`Id_Almacen`),
  KEY `Id_Almacen` (`Id_Almacen`),
  CONSTRAINT `almExistencias_Almacen_ibfk_1` FOREIGN KEY (`Id_Parte`) REFERENCES `almPartes` (`Id_Parte`) ON UPDATE CASCADE,
  CONSTRAINT `almExistencias_Almacen_ibfk_2` FOREIGN KEY (`Id_Almacen`) REFERENCES `almAlmacenes` (`Id_Almacen`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almExistencias_Almacen: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almExistencias_Almacen` DISABLE KEYS */;
/*!40000 ALTER TABLE `almExistencias_Almacen` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almFactura_Compra
CREATE TABLE IF NOT EXISTS `almFactura_Compra` (
  `Id_FactCompra` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro de la factura de compra',
  `Factura_Proveedor` varchar(20) NOT NULL COMMENT 'Numero de factura del proveedor',
  `Fecha_Documento` date NOT NULL COMMENT 'Fecha del documento del proveedor',
  `Id_Proveedor` int(11) NOT NULL COMMENT 'Identificador del proveedor a quien se le realizo la factura de compra',
  `Id_Propietario` int(11) NOT NULL COMMENT 'Identificador del propietario a quien se le asigna la factura de compra',
  `Estado` enum('SinAplicar','Aplicada','Cancelada') NOT NULL COMMENT 'Estado de la factura de compra',
  `Id_UsuarioRegistro` int(11) NOT NULL COMMENT 'Usuario que registro la orden de compra',
  `Subtotal` decimal(19,2) NOT NULL COMMENT 'Sumatorio de costos de las partidas de la orden de compra',
  `Impuestos` decimal(19,2) NOT NULL COMMENT 'Calculo de impuestos generados por el costo de las partidas',
  `Total` decimal(19,2) GENERATED ALWAYS AS (`Subtotal` + `Impuestos`) VIRTUAL COMMENT 'Calculo de suma de subtotal mas impuestos',
  `Saldo` decimal(19,2) DEFAULT 0.00 COMMENT 'Saldo pendiente de pago de la factura',
  `Observaciones` text DEFAULT NULL COMMENT 'Observaciones, notas o comentarios generales de la orden de compra',
  `filePDF` varchar(300) DEFAULT NULL COMMENT 'Ruta de la carpeta donde se almacena el archivo PDF del CFDI',
  `fileXML` varchar(300) DEFAULT NULL COMMENT 'Ruta de la carpeta donde se almacena el archivo XML del CFDI',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_FactCompra`),
  KEY `Id_Proveedor` (`Id_Proveedor`),
  KEY `Id_Propietario` (`Id_Propietario`),
  KEY `Id_UsuarioRegistro` (`Id_UsuarioRegistro`),
  CONSTRAINT `almFactura_Compra_ibfk_1` FOREIGN KEY (`Id_Proveedor`) REFERENCES `graProveedores` (`Id_Proveedor`) ON UPDATE CASCADE,
  CONSTRAINT `almFactura_Compra_ibfk_2` FOREIGN KEY (`Id_Propietario`) REFERENCES `graPropietarios` (`Id_Propietario`) ON UPDATE CASCADE,
  CONSTRAINT `almFactura_Compra_ibfk_3` FOREIGN KEY (`Id_UsuarioRegistro`) REFERENCES `cfgUsuarios` (`Id_Usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almFactura_Compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almFactura_Compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `almFactura_Compra` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almOrden_Compra
CREATE TABLE IF NOT EXISTS `almOrden_Compra` (
  `Id_Orden` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico de la orden de compra',
  `Folio` int(11) NOT NULL COMMENT 'Folio consecutivo que le corresponde de acuerdo a la tabla de folios documentos',
  `Serie` varchar(5) DEFAULT NULL COMMENT 'Serie asignada segun tabla de folios de documentos',
  `Id_Proveedor` int(11) NOT NULL COMMENT 'Identificador del proveedor a quien se le realiza la orden de compra',
  `Id_Propietario` int(11) NOT NULL COMMENT 'Identificador del propietario a quien se le asigna la orden de compra',
  `Estado` enum('PendAutorizar','SinSurtir','Parcialmente','Recibida','Cancelada') NOT NULL COMMENT 'Estado de la orden de compra',
  `Id_UsuarioRegistro` int(11) NOT NULL COMMENT 'Usuario que registro la orden de compra',
  `Id_UsuarioAutoriza` int(11) DEFAULT NULL COMMENT 'Usuario que autorizo la orden de compra para su pedido',
  `Fecha_Autorizacion` datetime DEFAULT NULL COMMENT 'Fecha y hora en que fue autorizada la orden de compra',
  `Subtotal` decimal(19,2) NOT NULL COMMENT 'Sumatorio de costos de las partidas de la orden de compra',
  `Impuestos` decimal(19,2) NOT NULL COMMENT 'Calculo de impuestos generados por el costo de las partidas',
  `Total` decimal(19,2) GENERATED ALWAYS AS (`Subtotal` + `Impuestos`) VIRTUAL COMMENT 'Calculo de suma de subtotal mas impuestos',
  `Observaciones` text DEFAULT NULL COMMENT 'Observaciones, notas o comentarios generales de la orden de compra',
  `filePDF` varchar(300) DEFAULT NULL COMMENT 'Ruta de la carpeta donde se almacena el archivo digitalizado de la orden de compra',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Orden`),
  KEY `Id_Proveedor` (`Id_Proveedor`),
  KEY `Id_Propietario` (`Id_Propietario`),
  KEY `Id_UsuarioRegistro` (`Id_UsuarioRegistro`),
  KEY `Id_UsuarioAutoriza` (`Id_UsuarioAutoriza`),
  CONSTRAINT `almOrden_Compra_ibfk_1` FOREIGN KEY (`Id_Proveedor`) REFERENCES `graProveedores` (`Id_Proveedor`) ON UPDATE CASCADE,
  CONSTRAINT `almOrden_Compra_ibfk_2` FOREIGN KEY (`Id_Propietario`) REFERENCES `graPropietarios` (`Id_Propietario`) ON UPDATE CASCADE,
  CONSTRAINT `almOrden_Compra_ibfk_3` FOREIGN KEY (`Id_UsuarioRegistro`) REFERENCES `cfgUsuarios` (`Id_Usuario`) ON UPDATE CASCADE,
  CONSTRAINT `almOrden_Compra_ibfk_4` FOREIGN KEY (`Id_UsuarioAutoriza`) REFERENCES `cfgUsuarios` (`Id_Usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almOrden_Compra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almOrden_Compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `almOrden_Compra` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almPartes
CREATE TABLE IF NOT EXISTS `almPartes` (
  `Id_Parte` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico de la Parte',
  `Codigo_Alterno` varchar(60) DEFAULT NULL COMMENT 'Codigo alterno o secundario de la parte',
  `Descripcion` varchar(200) NOT NULL COMMENT 'Descripción de la parte',
  `Ficha_Tecnica` varchar(500) DEFAULT NULL COMMENT 'Detalle, usos o especificaciones extendidas de la parte',
  `Id_Tipo` int(11) NOT NULL COMMENT 'Tipo de inventario al que pertenece la parte',
  `Minimo` int(11) DEFAULT 0 COMMENT 'Mínimo de piezas en existencias de la parte',
  `Maixmo` int(11) DEFAULT 0 COMMENT 'Máximo de piezas en existencias de la parte',
  `Punto_Reorden` int(11) DEFAULT 0 COMMENT 'Punto para re ordernar piezas al proveedor',
  `Costo_Reposicion` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Lo que cuesta reponer la pieza en el inventario',
  `Ultimo_Costo` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Lo que cuesta reponer la pieza en el inventario',
  `Fecha_UltimaCompra` date DEFAULT NULL COMMENT 'Fecha de la ultima vez que se compro la pieza',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Parte`),
  UNIQUE KEY `Codigo_Alterno` (`Codigo_Alterno`),
  KEY `Id_Tipo` (`Id_Tipo`),
  CONSTRAINT `almPartes_ibfk_1` FOREIGN KEY (`Id_Tipo`) REFERENCES `almTipos_Inventario` (`Id_Tipo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almPartes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almPartes` DISABLE KEYS */;
/*!40000 ALTER TABLE `almPartes` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almPartes_Proveedores
CREATE TABLE IF NOT EXISTS `almPartes_Proveedores` (
  `Id_Parte` int(11) NOT NULL COMMENT 'Identificador de la Parte',
  `Id_Proveedor` int(11) NOT NULL COMMENT 'Identificador del proveedor',
  `Codigo_Proveedor` varchar(60) NOT NULL COMMENT 'Codigo con el que identifica la pieza el proveedor',
  `EsPrincipal` enum('S','N') NOT NULL DEFAULT 'N' COMMENT 'Identifica si el proveedor es el principal para surtir la pieza',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  UNIQUE KEY `Id_Parte` (`Id_Parte`,`Id_Proveedor`),
  KEY `Id_Proveedor` (`Id_Proveedor`),
  CONSTRAINT `almPartes_Proveedores_ibfk_1` FOREIGN KEY (`Id_Parte`) REFERENCES `almPartes` (`Id_Parte`) ON UPDATE CASCADE,
  CONSTRAINT `almPartes_Proveedores_ibfk_2` FOREIGN KEY (`Id_Proveedor`) REFERENCES `graProveedores` (`Id_Proveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almPartes_Proveedores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almPartes_Proveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `almPartes_Proveedores` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almPartes_Ubicaciones
CREATE TABLE IF NOT EXISTS `almPartes_Ubicaciones` (
  `Id_Parte` int(11) NOT NULL COMMENT 'Identificador de la parte',
  `Id_Almacen` int(11) NOT NULL COMMENT 'Identificador del almacen',
  `UbiNivel1` int(11) NOT NULL COMMENT 'Identificador de la ubicación del nivel 1',
  `UbiNivel2` int(11) NOT NULL COMMENT 'Identificador de la ubicación del nivel 2',
  `UbiNivel3` int(11) NOT NULL COMMENT 'Identificador de la ubicación del nivel 3',
  `UbiNivel4` int(11) NOT NULL COMMENT 'Identificador de la ubicación del nivel 4',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `Id_Parte` (`Id_Parte`),
  KEY `Id_Almacen` (`Id_Almacen`),
  CONSTRAINT `almPartes_Ubicaciones_ibfk_1` FOREIGN KEY (`Id_Parte`) REFERENCES `almPartes` (`Id_Parte`) ON UPDATE CASCADE,
  CONSTRAINT `almPartes_Ubicaciones_ibfk_2` FOREIGN KEY (`Id_Almacen`) REFERENCES `almAlmacenes` (`Id_Almacen`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almPartes_Ubicaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almPartes_Ubicaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `almPartes_Ubicaciones` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almTipos_Inventario
CREATE TABLE IF NOT EXISTS `almTipos_Inventario` (
  `Id_Tipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del tipo de inventario',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción del tipo de inventario ejemplo, Refacciones, Consumibles, etc ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almTipos_Inventario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almTipos_Inventario` DISABLE KEYS */;
/*!40000 ALTER TABLE `almTipos_Inventario` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almTipos_Mov_Almacen
CREATE TABLE IF NOT EXISTS `almTipos_Mov_Almacen` (
  `Id_TipoMov` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del tipo de movimiento',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción del tipo de movimiento ejemplo, Pieza Dañada, Ajuste al inventario, etc ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_TipoMov`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almTipos_Mov_Almacen: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almTipos_Mov_Almacen` DISABLE KEYS */;
/*!40000 ALTER TABLE `almTipos_Mov_Almacen` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almTraspaso
CREATE TABLE IF NOT EXISTS `almTraspaso` (
  `Id_Traspaso` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del traspaso',
  `Folio` int(11) NOT NULL COMMENT 'Folio asignado consecutivo de la tabla de folios de documentos',
  `Serie` varchar(5) DEFAULT NULL COMMENT 'Serie asignado de la tabla de folios de documentos',
  `Id_AlmacenOri` int(11) NOT NULL COMMENT 'Identificador del Almacen Origen',
  `Id_AlmacenDes` int(11) NOT NULL COMMENT 'Identificador del Almacen Destino',
  `Costotal` decimal(19,2) NOT NULL DEFAULT 0.00 COMMENT 'Sumatorio de los costos de las partidas del traspaso',
  `Observaciones` text DEFAULT NULL COMMENT 'Detalles, Notas, Observaciones del traspaso',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Traspaso`),
  KEY `Id_AlmacenOri` (`Id_AlmacenOri`),
  KEY `Id_AlmacenDes` (`Id_AlmacenDes`),
  CONSTRAINT `almTraspaso_ibfk_1` FOREIGN KEY (`Id_AlmacenOri`) REFERENCES `almAlmacenes` (`Id_Almacen`) ON UPDATE CASCADE,
  CONSTRAINT `almTraspaso_ibfk_2` FOREIGN KEY (`Id_AlmacenDes`) REFERENCES `almAlmacenes` (`Id_Almacen`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almTraspaso: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almTraspaso` DISABLE KEYS */;
/*!40000 ALTER TABLE `almTraspaso` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.almUbicaciones
CREATE TABLE IF NOT EXISTS `almUbicaciones` (
  `Id_Ubicacion` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico de la Ubicación',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción de la ubicación ejemplo, Pasillo A, Pasillo B, etc ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Ubicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.almUbicaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `almUbicaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `almUbicaciones` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.cfgDepartamento
CREATE TABLE IF NOT EXISTS `cfgDepartamento` (
  `Id_Departamento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del departamento',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción del departamento, Contabilidad, Administración,etc',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.cfgDepartamento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cfgDepartamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `cfgDepartamento` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.cfgFolios_Doctos
CREATE TABLE IF NOT EXISTS `cfgFolios_Doctos` (
  `Id_Folio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Unico del Folio',
  `Documento` varchar(60) NOT NULL COMMENT 'Nombre o descripción del Documento ejemplo Factura de Compra, Traspaso',
  `FolioSiguiente` int(11) NOT NULL DEFAULT 0,
  `Serie` varchar(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Folio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.cfgFolios_Doctos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cfgFolios_Doctos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cfgFolios_Doctos` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.cfgModulos
CREATE TABLE IF NOT EXISTS `cfgModulos` (
  `Id_Modulo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Unico del Modulo',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción del modulo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.cfgModulos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cfgModulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cfgModulos` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.cfgModulos_Permisos
CREATE TABLE IF NOT EXISTS `cfgModulos_Permisos` (
  `Id_Modulo` int(11) NOT NULL COMMENT 'Identificador del Modulo',
  `Id_Permiso` int(11) NOT NULL COMMENT 'Identificador del Permiso',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  UNIQUE KEY `Id_Modulo` (`Id_Modulo`,`Id_Permiso`),
  KEY `Id_Permiso` (`Id_Permiso`),
  CONSTRAINT `cfgModulos_Permisos_ibfk_1` FOREIGN KEY (`Id_Modulo`) REFERENCES `cfgModulos` (`Id_Modulo`) ON UPDATE CASCADE,
  CONSTRAINT `cfgModulos_Permisos_ibfk_2` FOREIGN KEY (`Id_Permiso`) REFERENCES `cfgPermisos` (`Id_Permiso`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.cfgModulos_Permisos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cfgModulos_Permisos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cfgModulos_Permisos` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.cfgPermisos
CREATE TABLE IF NOT EXISTS `cfgPermisos` (
  `Id_Permiso` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Unico del Permiso',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción del Permiso ejemplo Registrar, Eliminar, Consultar',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.cfgPermisos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cfgPermisos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cfgPermisos` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.cfgRoles
CREATE TABLE IF NOT EXISTS `cfgRoles` (
  `Id_Rol` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Unico del Rol',
  `Nombre` varchar(60) NOT NULL COMMENT 'Nombre o descripción del rol ejemplo, Supervisor, Administrativo,Administrador',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.cfgRoles: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cfgRoles` DISABLE KEYS */;
/*!40000 ALTER TABLE `cfgRoles` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.cfgUsuarios
CREATE TABLE IF NOT EXISTS `cfgUsuarios` (
  `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Unico del Usuario',
  `usuario` varchar(30) NOT NULL COMMENT 'Nombre de usuario ',
  `Password` varchar(60) NOT NULL COMMENT 'Password del usuario',
  `Nombre` varchar(120) NOT NULL COMMENT 'Nombre completo del usuario',
  `email` varchar(200) NOT NULL COMMENT 'Correo electronico del usuario',
  `Activo` enum('Activo','Inactivo') DEFAULT 'Activo' COMMENT 'Indica si esl usuario esta 1 activo o 0 inactivo',
  `Id_Rol` int(11) NOT NULL COMMENT 'Rol que desempeña el usuario',
  `Id_Departamento` int(11) NOT NULL COMMENT 'Departamento al cual pertenece el usuario',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Usuario`),
  KEY `Id_Rol` (`Id_Rol`),
  KEY `Id_Departamento` (`Id_Departamento`),
  CONSTRAINT `cfgUsuarios_ibfk_1` FOREIGN KEY (`Id_Rol`) REFERENCES `cfgRoles` (`Id_Rol`) ON UPDATE CASCADE,
  CONSTRAINT `cfgUsuarios_ibfk_2` FOREIGN KEY (`Id_Departamento`) REFERENCES `cfgDepartamento` (`Id_Departamento`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.cfgUsuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cfgUsuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `cfgUsuarios` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.cfgUsuarios_Permisos
CREATE TABLE IF NOT EXISTS `cfgUsuarios_Permisos` (
  `Id_Usuario` int(11) NOT NULL COMMENT 'Identificador del usuario',
  `Id_Modulo` int(11) NOT NULL COMMENT 'Identificador del modeulo',
  `Id_Permiso` int(11) NOT NULL COMMENT 'Identificador del permiso',
  UNIQUE KEY `Id_Usuario` (`Id_Usuario`,`Id_Modulo`,`Id_Permiso`),
  KEY `Id_Modulo` (`Id_Modulo`),
  KEY `Id_Permiso` (`Id_Permiso`),
  CONSTRAINT `cfgUsuarios_Permisos_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `cfgUsuarios` (`Id_Usuario`) ON UPDATE CASCADE,
  CONSTRAINT `cfgUsuarios_Permisos_ibfk_2` FOREIGN KEY (`Id_Modulo`) REFERENCES `cfgModulos` (`Id_Modulo`) ON UPDATE CASCADE,
  CONSTRAINT `cfgUsuarios_Permisos_ibfk_3` FOREIGN KEY (`Id_Permiso`) REFERENCES `cfgPermisos` (`Id_Permiso`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.cfgUsuarios_Permisos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cfgUsuarios_Permisos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cfgUsuarios_Permisos` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.graClientes
CREATE TABLE IF NOT EXISTS `graClientes` (
  `Id_Cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Unico del Cliente',
  `Nombres` varchar(60) NOT NULL COMMENT 'Nombre del Cliente',
  `APaterno` varchar(60) DEFAULT NULL COMMENT 'Apellido Cliente',
  `AMaterno` varchar(60) DEFAULT NULL COMMENT 'Apellido Materno Opcional',
  `NombreCompleto` varchar(180) GENERATED ALWAYS AS (concat(`Nombres`,' ',`APaterno`,' ',`AMaterno`)) VIRTUAL COMMENT 'Nombre completo concatenado columna calculada',
  `RazonSocial` varchar(200) DEFAULT NULL COMMENT 'Razón social',
  `RFC` varchar(13) DEFAULT NULL COMMENT 'Registro Federal de Contribuyentes',
  `Calle` varchar(60) DEFAULT NULL COMMENT 'Nombre de la calle del domicilio del colaborador',
  `Colonia` varchar(60) DEFAULT NULL COMMENT 'Nombre de la colonia del domicilio del colaborador',
  `CP` varchar(5) DEFAULT NULL COMMENT 'Codigo Postal',
  `Estado` varchar(60) DEFAULT NULL COMMENT 'Nombre del estado del domicilio del colaborador',
  `Celular` varchar(20) DEFAULT NULL COMMENT 'Numero de linea celular del colaborador',
  `Telefono` varchar(20) DEFAULT NULL COMMENT 'Numero alternativo de linea celular',
  `email` varchar(60) DEFAULT NULL COMMENT 'Correo electronico del colaborador',
  `Tipo_Persona` enum('Fisica','Moral') DEFAULT NULL COMMENT 'Tipo de entidad',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.graClientes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `graClientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `graClientes` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.graPropietarios
CREATE TABLE IF NOT EXISTS `graPropietarios` (
  `Id_Propietario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Unico del Propietario',
  `Nombres` varchar(60) NOT NULL COMMENT 'Nombre del Propietario',
  `APaterno` varchar(60) DEFAULT NULL COMMENT 'Apellido Paterno',
  `AMaterno` varchar(60) DEFAULT NULL COMMENT 'Apellido Materno Opcional',
  `NombreCompleto` varchar(180) GENERATED ALWAYS AS (concat(`Nombres`,' ',`APaterno`,' ',`AMaterno`)) VIRTUAL COMMENT 'Nombre completo concatenado columna calculada',
  `RazonSocial` varchar(200) DEFAULT NULL COMMENT 'Razón social',
  `RFC` varchar(13) DEFAULT NULL COMMENT 'Registro Federal de Contribuyentes',
  `Calle` varchar(60) DEFAULT NULL COMMENT 'Nombre de la calle del domicilio del colaborador',
  `Colonia` varchar(60) DEFAULT NULL COMMENT 'Nombre de la colonia del domicilio del colaborador',
  `CP` varchar(5) DEFAULT NULL COMMENT 'Codigo Postal',
  `Estado` varchar(60) DEFAULT NULL COMMENT 'Nombre del estado del domicilio del colaborador',
  `Celular` varchar(20) DEFAULT NULL COMMENT 'Numero de linea celular del colaborador',
  `Telefono` varchar(20) DEFAULT NULL COMMENT 'Numero alternativo de linea celular',
  `email` varchar(60) DEFAULT NULL COMMENT 'Correo electronico del colaborador',
  `Tipo_Persona` enum('Fisica','Moral') DEFAULT NULL COMMENT 'Tipo de entidad',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Propietario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.graPropietarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `graPropietarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `graPropietarios` ENABLE KEYS */;

-- Volcando estructura para tabla Transporte.graProveedores
CREATE TABLE IF NOT EXISTS `graProveedores` (
  `Id_Proveedor` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador Unico del Proveedor',
  `Nombres` varchar(60) NOT NULL COMMENT 'Nombre del Proveedor',
  `APaterno` varchar(60) DEFAULT NULL COMMENT 'Apellido Proveedor',
  `AMaterno` varchar(60) DEFAULT NULL COMMENT 'Apellido Materno Opcional',
  `NombreCompleto` varchar(180) GENERATED ALWAYS AS (concat(`Nombres`,' ',`APaterno`,' ',`AMaterno`)) VIRTUAL COMMENT 'Nombre completo concatenado columna calculada',
  `RazonSocial` varchar(200) DEFAULT NULL COMMENT 'Razón social',
  `RFC` varchar(13) DEFAULT NULL COMMENT 'Registro Federal de Contribuyentes',
  `Calle` varchar(60) DEFAULT NULL COMMENT 'Nombre de la calle del domicilio del colaborador',
  `Colonia` varchar(60) DEFAULT NULL COMMENT 'Nombre de la colonia del domicilio del colaborador',
  `CP` varchar(5) DEFAULT NULL COMMENT 'Codigo Postal',
  `Estado` varchar(60) DEFAULT NULL COMMENT 'Nombre del estado del domicilio del colaborador',
  `Celular` varchar(20) DEFAULT NULL COMMENT 'Numero de linea celular del colaborador',
  `Telefono` varchar(20) DEFAULT NULL COMMENT 'Numero alternativo de linea celular',
  `email` varchar(60) DEFAULT NULL COMMENT 'Correo electronico del colaborador',
  `Tipo_Persona` enum('Fisica','Moral') DEFAULT NULL COMMENT 'Tipo de entidad',
  `Dias_Entrega` int(11) NOT NULL DEFAULT 1 COMMENT 'Numero promedio de dias, para realizar sus entregas',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_Proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla Transporte.graProveedores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `graProveedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `graProveedores` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
