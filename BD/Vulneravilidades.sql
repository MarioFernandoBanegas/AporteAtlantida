-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         Microsoft SQL Server 2014 - 12.0.2000.8
-- SO del servidor:              Windows NT 6.3 <X64> (Build 17763: )
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES  */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para sv
CREATE DATABASE IF NOT EXISTS "sv";
USE "sv";

-- Volcando estructura para tabla sv.aplication
CREATE TABLE IF NOT EXISTS "aplication" (
	"Id_Aplication" INT(10,0) NOT NULL,
	"Name_Aplication" VARCHAR(100) NULL DEFAULT NULL,
	PRIMARY KEY ("Id_Aplication")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sv.connection
CREATE TABLE IF NOT EXISTS "connection" (
	"Id_Connection_state" INT(10,0) NOT NULL,
	"Name_Connection_state" VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY ("Id_Connection_state")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sv.db_server
CREATE TABLE IF NOT EXISTS "db_server" (
	"Id_Dbserver" INT(10,0) NOT NULL,
	"Name_server" VARCHAR(100) NULL DEFAULT NULL,
	PRIMARY KEY ("Id_Dbserver")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para función sv.fn_diagramobjects
DELIMITER //

	CREATE FUNCTION dbo.fn_diagramobjects() 
	RETURNS int
	WITH EXECUTE AS N'dbo'
	AS
	BEGIN
		declare @id_upgraddiagrams		int
		declare @id_sysdiagrams			int
		declare @id_helpdiagrams		int
		declare @id_helpdiagramdefinition	int
		declare @id_creatediagram	int
		declare @id_renamediagram	int
		declare @id_alterdiagram 	int 
		declare @id_dropdiagram		int
		declare @InstalledObjects	int

		select @InstalledObjects = 0

		select 	@id_upgraddiagrams = object_id(N'dbo.sp_upgraddiagrams'),
			@id_sysdiagrams = object_id(N'dbo.sysdiagrams'),
			@id_helpdiagrams = object_id(N'dbo.sp_helpdiagrams'),
			@id_helpdiagramdefinition = object_id(N'dbo.sp_helpdiagramdefinition'),
			@id_creatediagram = object_id(N'dbo.sp_creatediagram'),
			@id_renamediagram = object_id(N'dbo.sp_renamediagram'),
			@id_alterdiagram = object_id(N'dbo.sp_alterdiagram'), 
			@id_dropdiagram = object_id(N'dbo.sp_dropdiagram')

		if @id_upgraddiagrams is not null
			select @InstalledObjects = @InstalledObjects + 1
		if @id_sysdiagrams is not null
			select @InstalledObjects = @InstalledObjects + 2
		if @id_helpdiagrams is not null
			select @InstalledObjects = @InstalledObjects + 4
		if @id_helpdiagramdefinition is not null
			select @InstalledObjects = @InstalledObjects + 8
		if @id_creatediagram is not null
			select @InstalledObjects = @InstalledObjects + 16
		if @id_renamediagram is not null
			select @InstalledObjects = @InstalledObjects + 32
		if @id_alterdiagram  is not null
			select @InstalledObjects = @InstalledObjects + 64
		if @id_dropdiagram is not null
			select @InstalledObjects = @InstalledObjects + 128
		
		return @InstalledObjects 
	END
	//
DELIMITER ;

-- Volcando estructura para tabla sv.login
CREATE TABLE IF NOT EXISTS "login" (
	"id" INT(10,0) NOT NULL,
	"user" VARCHAR(250) NULL DEFAULT NULL,
	"email" VARCHAR(250) NULL DEFAULT NULL,
	"password" VARCHAR(250) NULL DEFAULT NULL,
	"pasadmin" VARCHAR(250) NULL DEFAULT NULL,
	"rol" INT(10,0) NULL DEFAULT NULL,
	PRIMARY KEY ("id")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sv.os
CREATE TABLE IF NOT EXISTS "os" (
	"Id_OS" INT(10,0) NOT NULL,
	"Name_OS" VARCHAR(150) NULL DEFAULT NULL,
	PRIMARY KEY ("Id_OS")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sv.pci
CREATE TABLE IF NOT EXISTS "pci" (
	"Id_SAS" INT(10,0) NOT NULL,
	"Name_SAS" VARCHAR(100) NULL DEFAULT NULL,
	PRIMARY KEY ("Id_SAS")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sv.power
CREATE TABLE IF NOT EXISTS "power" (
	"Id_Power" INT(10,0) NOT NULL,
	"Name_Power" VARCHAR(150) NULL DEFAULT NULL,
	PRIMARY KEY ("Id_Power")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sv.responsable
CREATE TABLE IF NOT EXISTS "responsable" (
	"Id_Responsable" INT(10,0) NOT NULL,
	"Nombre_Responsable" VARCHAR(200) NULL DEFAULT ('0'),
	PRIMARY KEY ("Id_Responsable")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sv.servers
CREATE TABLE IF NOT EXISTS "servers" (
	"id" INT(10,0) NOT NULL,
	"IP" VARCHAR(100) NULL DEFAULT NULL,
	"nombre" VARCHAR(100) NULL DEFAULT NULL,
	"procesadores" INT(10,0) NULL DEFAULT NULL,
	"ram" VARCHAR(100) NULL DEFAULT NULL,
	"host" VARCHAR(100) NULL DEFAULT NULL,
	"hora_servicio" VARCHAR(100) NULL DEFAULT NULL,
	"ul_fecha" VARCHAR(50) NULL DEFAULT NULL,
	"tls" VARCHAR(50) NULL DEFAULT NULL,
	"hardenizado" VARCHAR(50) NULL DEFAULT NULL,
	"espacio_pro" INT(10,0) NULL DEFAULT NULL,
	"espacio_usado" INT(10,0) NULL DEFAULT NULL,
	"dns" VARCHAR(100) NULL DEFAULT NULL,
	"Id_Type" INT(10,0) NULL DEFAULT NULL,
	"Id_SAS" INT(10,0) NULL DEFAULT NULL,
	"Id_Power" INT(10,0) NULL DEFAULT NULL,
	"Id_OS" INT(10,0) NULL DEFAULT NULL,
	"Id_Responsable" INT(10,0) NULL DEFAULT NULL,
	"Id_Zone" INT(10,0) NULL DEFAULT NULL,
	"Id_Aplication" INT(10,0) NULL DEFAULT NULL,
	"Id_Dbserver" INT(10,0) NULL DEFAULT NULL,
	"Id_Connection_state" INT(10,0) NULL DEFAULT NULL,
	"contingencia" VARCHAR(500) NULL DEFAULT NULL,
	"observaciones" VARCHAR(500) NULL DEFAULT NULL,
	PRIMARY KEY ("id")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para procedimiento sv.sp_alterdiagram
DELIMITER //

	CREATE PROCEDURE dbo.sp_alterdiagram
	(
		@diagramname 	sysname,
		@owner_id	int	= null,
		@version 	int,
		@definition 	varbinary(max)
	)
	WITH EXECUTE AS 'dbo'
	AS
	BEGIN
		set nocount on
	
		declare @theId 			int
		declare @retval 		int
		declare @IsDbo 			int
		
		declare @UIDFound 		int
		declare @DiagId			int
		declare @ShouldChangeUID	int
	
		if(@diagramname is null)
		begin
			RAISERROR ('Invalid ARG', 16, 1)
			return -1
		end
	
		execute as caller;
		select @theId = DATABASE_PRINCIPAL_ID();	 
		select @IsDbo = IS_MEMBER(N'db_owner'); 
		if(@owner_id is null)
			select @owner_id = @theId;
		revert;
	
		select @ShouldChangeUID = 0
		select @DiagId = diagram_id, @UIDFound = principal_id from dbo.sysdiagrams where principal_id = @owner_id and name = @diagramname 
		
		if(@DiagId IS NULL or (@IsDbo = 0 and @theId <> @UIDFound))
		begin
			RAISERROR ('Diagram does not exist or you do not have permission.', 16, 1);
			return -3
		end
	
		if(@IsDbo <> 0)
		begin
			if(@UIDFound is null or USER_NAME(@UIDFound) is null) -- invalid principal_id
			begin
				select @ShouldChangeUID = 1 ;
			end
		end

		-- update dds data			
		update dbo.sysdiagrams set definition = @definition where diagram_id = @DiagId ;

		-- change owner
		if(@ShouldChangeUID = 1)
			update dbo.sysdiagrams set principal_id = @theId where diagram_id = @DiagId ;

		-- update dds version
		if(@version is not null)
			update dbo.sysdiagrams set version = @version where diagram_id = @DiagId ;

		return 0
	END
	//
DELIMITER ;

-- Volcando estructura para procedimiento sv.sp_creatediagram
DELIMITER //

	CREATE PROCEDURE dbo.sp_creatediagram
	(
		@diagramname 	sysname,
		@owner_id		int	= null, 	
		@version 		int,
		@definition 	varbinary(max)
	)
	WITH EXECUTE AS 'dbo'
	AS
	BEGIN
		set nocount on
	
		declare @theId int
		declare @retval int
		declare @IsDbo	int
		declare @userName sysname
		if(@version is null or @diagramname is null)
		begin
			RAISERROR (N'E_INVALIDARG', 16, 1);
			return -1
		end
	
		execute as caller;
		select @theId = DATABASE_PRINCIPAL_ID(); 
		select @IsDbo = IS_MEMBER(N'db_owner');
		revert; 
		
		if @owner_id is null
		begin
			select @owner_id = @theId;
		end
		else
		begin
			if @theId <> @owner_id
			begin
				if @IsDbo = 0
				begin
					RAISERROR (N'E_INVALIDARG', 16, 1);
					return -1
				end
				select @theId = @owner_id
			end
		end
		-- next 2 line only for test, will be removed after define name unique
		if EXISTS(select diagram_id from dbo.sysdiagrams where principal_id = @theId and name = @diagramname)
		begin
			RAISERROR ('The name is already used.', 16, 1);
			return -2
		end
	
		insert into dbo.sysdiagrams(name, principal_id , version, definition)
				VALUES(@diagramname, @theId, @version, @definition) ;
		
		select @retval = @@IDENTITY 
		return @retval
	END
	//
DELIMITER ;

-- Volcando estructura para procedimiento sv.sp_dropdiagram
DELIMITER //

	CREATE PROCEDURE dbo.sp_dropdiagram
	(
		@diagramname 	sysname,
		@owner_id	int	= null
	)
	WITH EXECUTE AS 'dbo'
	AS
	BEGIN
		set nocount on
		declare @theId 			int
		declare @IsDbo 			int
		
		declare @UIDFound 		int
		declare @DiagId			int
	
		if(@diagramname is null)
		begin
			RAISERROR ('Invalid value', 16, 1);
			return -1
		end
	
		EXECUTE AS CALLER;
		select @theId = DATABASE_PRINCIPAL_ID();
		select @IsDbo = IS_MEMBER(N'db_owner'); 
		if(@owner_id is null)
			select @owner_id = @theId;
		REVERT; 
		
		select @DiagId = diagram_id, @UIDFound = principal_id from dbo.sysdiagrams where principal_id = @owner_id and name = @diagramname 
		if(@DiagId IS NULL or (@IsDbo = 0 and @UIDFound <> @theId))
		begin
			RAISERROR ('Diagram does not exist or you do not have permission.', 16, 1)
			return -3
		end
	
		delete from dbo.sysdiagrams where diagram_id = @DiagId;
	
		return 0;
	END
	//
DELIMITER ;

-- Volcando estructura para procedimiento sv.sp_helpdiagramdefinition
DELIMITER //

	CREATE PROCEDURE dbo.sp_helpdiagramdefinition
	(
		@diagramname 	sysname,
		@owner_id	int	= null 		
	)
	WITH EXECUTE AS N'dbo'
	AS
	BEGIN
		set nocount on

		declare @theId 		int
		declare @IsDbo 		int
		declare @DiagId		int
		declare @UIDFound	int
	
		if(@diagramname is null)
		begin
			RAISERROR (N'E_INVALIDARG', 16, 1);
			return -1
		end
	
		execute as caller;
		select @theId = DATABASE_PRINCIPAL_ID();
		select @IsDbo = IS_MEMBER(N'db_owner');
		if(@owner_id is null)
			select @owner_id = @theId;
		revert; 
	
		select @DiagId = diagram_id, @UIDFound = principal_id from dbo.sysdiagrams where principal_id = @owner_id and name = @diagramname;
		if(@DiagId IS NULL or (@IsDbo = 0 and @UIDFound <> @theId ))
		begin
			RAISERROR ('Diagram does not exist or you do not have permission.', 16, 1);
			return -3
		end

		select version, definition FROM dbo.sysdiagrams where diagram_id = @DiagId ; 
		return 0
	END
	//
DELIMITER ;

-- Volcando estructura para procedimiento sv.sp_helpdiagrams
DELIMITER //

	CREATE PROCEDURE dbo.sp_helpdiagrams
	(
		@diagramname sysname = NULL,
		@owner_id int = NULL
	)
	WITH EXECUTE AS N'dbo'
	AS
	BEGIN
		DECLARE @user sysname
		DECLARE @dboLogin bit
		EXECUTE AS CALLER;
			SET @user = USER_NAME();
			SET @dboLogin = CONVERT(bit,IS_MEMBER('db_owner'));
		REVERT;
		SELECT
			[Database] = DB_NAME(),
			[Name] = name,
			[ID] = diagram_id,
			[Owner] = USER_NAME(principal_id),
			[OwnerID] = principal_id
		FROM
			sysdiagrams
		WHERE
			(@dboLogin = 1 OR USER_NAME(principal_id) = @user) AND
			(@diagramname IS NULL OR name = @diagramname) AND
			(@owner_id IS NULL OR principal_id = @owner_id)
		ORDER BY
			4, 5, 1
	END
	//
DELIMITER ;

-- Volcando estructura para procedimiento sv.sp_renamediagram
DELIMITER //

	CREATE PROCEDURE dbo.sp_renamediagram
	(
		@diagramname 		sysname,
		@owner_id		int	= null,
		@new_diagramname	sysname
	
	)
	WITH EXECUTE AS 'dbo'
	AS
	BEGIN
		set nocount on
		declare @theId 			int
		declare @IsDbo 			int
		
		declare @UIDFound 		int
		declare @DiagId			int
		declare @DiagIdTarg		int
		declare @u_name			sysname
		if((@diagramname is null) or (@new_diagramname is null))
		begin
			RAISERROR ('Invalid value', 16, 1);
			return -1
		end
	
		EXECUTE AS CALLER;
		select @theId = DATABASE_PRINCIPAL_ID();
		select @IsDbo = IS_MEMBER(N'db_owner'); 
		if(@owner_id is null)
			select @owner_id = @theId;
		REVERT;
	
		select @u_name = USER_NAME(@owner_id)
	
		select @DiagId = diagram_id, @UIDFound = principal_id from dbo.sysdiagrams where principal_id = @owner_id and name = @diagramname 
		if(@DiagId IS NULL or (@IsDbo = 0 and @UIDFound <> @theId))
		begin
			RAISERROR ('Diagram does not exist or you do not have permission.', 16, 1)
			return -3
		end
	
		-- if((@u_name is not null) and (@new_diagramname = @diagramname))	-- nothing will change
		--	return 0;
	
		if(@u_name is null)
			select @DiagIdTarg = diagram_id from dbo.sysdiagrams where principal_id = @theId and name = @new_diagramname
		else
			select @DiagIdTarg = diagram_id from dbo.sysdiagrams where principal_id = @owner_id and name = @new_diagramname
	
		if((@DiagIdTarg is not null) and  @DiagId <> @DiagIdTarg)
		begin
			RAISERROR ('The name is already used.', 16, 1);
			return -2
		end		
	
		if(@u_name is null)
			update dbo.sysdiagrams set [name] = @new_diagramname, principal_id = @theId where diagram_id = @DiagId
		else
			update dbo.sysdiagrams set [name] = @new_diagramname where diagram_id = @DiagId
		return 0
	END
	//
DELIMITER ;

-- Volcando estructura para procedimiento sv.sp_upgraddiagrams
DELIMITER //

	CREATE PROCEDURE dbo.sp_upgraddiagrams
	AS
	BEGIN
		IF OBJECT_ID(N'dbo.sysdiagrams') IS NOT NULL
			return 0;
	
		CREATE TABLE dbo.sysdiagrams
		(
			name sysname NOT NULL,
			principal_id int NOT NULL,	-- we may change it to varbinary(85)
			diagram_id int PRIMARY KEY IDENTITY,
			version int,
	
			definition varbinary(max)
			CONSTRAINT UK_principal_name UNIQUE
			(
				principal_id,
				name
			)
		);


		/* Add this if we need to have some form of extended properties for diagrams */
		/*
		IF OBJECT_ID(N'dbo.sysdiagram_properties') IS NULL
		BEGIN
			CREATE TABLE dbo.sysdiagram_properties
			(
				diagram_id int,
				name sysname,
				value varbinary(max) NOT NULL
			)
		END
		*/

		IF OBJECT_ID(N'dbo.dtproperties') IS NOT NULL
		begin
			insert into dbo.sysdiagrams
			(
				[name],
				[principal_id],
				[version],
				[definition]
			)
			select	 
				convert(sysname, dgnm.[uvalue]),
				DATABASE_PRINCIPAL_ID(N'dbo'),			-- will change to the sid of sa
				0,							-- zero for old format, dgdef.[version],
				dgdef.[lvalue]
			from dbo.[dtproperties] dgnm
				inner join dbo.[dtproperties] dggd on dggd.[property] = 'DtgSchemaGUID' and dggd.[objectid] = dgnm.[objectid]	
				inner join dbo.[dtproperties] dgdef on dgdef.[property] = 'DtgSchemaDATA' and dgdef.[objectid] = dgnm.[objectid]
				
			where dgnm.[property] = 'DtgSchemaNAME' and dggd.[uvalue] like N'_EA3E6268-D998-11CE-9454-00AA00A3F36E_' 
			return 2;
		end
		return 1;
	END
	//
DELIMITER ;

-- Volcando estructura para tabla sv.sysdiagrams
CREATE TABLE IF NOT EXISTS "sysdiagrams" (
	"name" NVARCHAR(128) NOT NULL,
	"principal_id" INT(10,0) NOT NULL,
	"diagram_id" INT(10,0) NOT NULL,
	"version" INT(10,0) NULL DEFAULT NULL,
	"definition" VARBINARY(max) NULL DEFAULT NULL,
	PRIMARY KEY ("diagram_id"),
	UNIQUE KEY ("principal_id","name")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sv.type
CREATE TABLE IF NOT EXISTS "type" (
	"Id_Type" INT(10,0) NOT NULL,
	"Name_Type" VARCHAR(100) NULL DEFAULT NULL,
	PRIMARY KEY ("Id_Type")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sv.vulnera
CREATE TABLE IF NOT EXISTS "vulnera" (
	"id_vul" INT(10,0) NOT NULL,
	"IP" VARCHAR(50) NULL DEFAULT NULL,
	"Servidor" VARCHAR(100) NULL DEFAULT NULL,
	"EstadoRiesgo" VARCHAR(100) NULL DEFAULT NULL,
	"SeveridadRiesgo" VARCHAR(100) NULL DEFAULT NULL,
	"Protocolo" VARCHAR(100) NULL DEFAULT NULL,
	"Puerto" INT(10,0) NULL DEFAULT NULL,
	"Responsable" VARCHAR(200) NULL DEFAULT NULL,
	"AreaResponsable" VARCHAR(200) NULL DEFAULT NULL,
	"TipoAmenaza" VARCHAR(200) NULL DEFAULT NULL,
	"Solucion" VARCHAR(500) NULL DEFAULT NULL,
	"Descripcion" VARCHAR(500) NULL DEFAULT NULL,
	"PlanAccion" VARCHAR(500) NULL DEFAULT NULL,
	"Evidencias" VARCHAR(500) NULL DEFAULT NULL,
	"Observaciones" VARCHAR(500) NULL DEFAULT NULL,
	"FechaEstimadaCierre" DATE(0) NULL DEFAULT NULL,
	"FechaEstimadaCierreProyecto" DATE(0) NULL DEFAULT NULL,
	"NumeroProyecto" INT(10,0) NULL DEFAULT NULL,
	"activo" INT(10,0) NULL DEFAULT NULL,
	PRIMARY KEY ("id_vul")
);

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla sv.zone
CREATE TABLE IF NOT EXISTS "zone" (
	"Id_Zone" INT(10,0) NOT NULL,
	"Name_Zone" VARCHAR(100) NULL DEFAULT NULL,
	PRIMARY KEY ("Id_Zone")
);

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
