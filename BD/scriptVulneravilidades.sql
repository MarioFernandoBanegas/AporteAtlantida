use [sv]v
GO
/****** Object:  Table [dbo].[aplication]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[aplication](
	[Id_Aplication] [int] IDENTITY(1,1) NOT NULL,
	[Name_Aplication] [varchar](100) NULL,
 CONSTRAINT [PK_aplication] PRIMARY KEY CLUSTERED 
(
	[Id_Aplication] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[connection]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[connection](
	[Id_Connection_state] [int] IDENTITY(1,1) NOT NULL,
	[Name_Connection_state] [varchar](50) NULL,
 CONSTRAINT [PK_connection] PRIMARY KEY CLUSTERED 
(
	[Id_Connection_state] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[db_server]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[db_server](
	[Id_Dbserver] [int] IDENTITY(1,1) NOT NULL,
	[Name_server] [varchar](100) NULL,
 CONSTRAINT [PK_db_server] PRIMARY KEY CLUSTERED 
(
	[Id_Dbserver] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[login]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[login](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[user] [varchar](250) NULL,
	[email] [varchar](250) NULL,
	[password] [varchar](250) NULL,
	[pasadmin] [varchar](250) NULL,
	[rol] [int] NULL,
 CONSTRAINT [PK_login] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[os]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[os](
	[Id_OS] [int] IDENTITY(1,1) NOT NULL,
	[Name_OS] [varchar](150) NULL,
 CONSTRAINT [PK_os] PRIMARY KEY CLUSTERED 
(
	[Id_OS] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[pci]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[pci](
	[Id_SAS] [int] IDENTITY(1,1) NOT NULL,
	[Name_SAS] [varchar](100) NULL,
 CONSTRAINT [PK_pci] PRIMARY KEY CLUSTERED 
(
	[Id_SAS] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[power]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[power](
	[Id_Power] [int] IDENTITY(1,1) NOT NULL,
	[Name_Power] [varchar](150) NULL,
 CONSTRAINT [PK_power] PRIMARY KEY CLUSTERED 
(
	[Id_Power] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[responsable]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[responsable](
	[Id_Responsable] [int] IDENTITY(1,1) NOT NULL,
	[Nombre_Responsable] [varchar](200) NULL CONSTRAINT [DF__responsab__Nombr__108B795B]  DEFAULT ('0'),
 CONSTRAINT [PK__responsa__CC3DF26679742736] PRIMARY KEY CLUSTERED 
(
	[Id_Responsable] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[servers]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[servers](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[IP] [varchar](100) NULL,
	[nombre] [varchar](100) NULL,
	[procesadores] [int] NULL,
	[ram] [varchar](100) NULL,
	[host] [varchar](100) NULL,
	[hora_servicio] [varchar](100) NULL,
	[ul_fecha] [varchar](50) NULL,
	[tls] [varchar](50) NULL,
	[hardenizado] [varchar](50) NULL,
	[espacio_pro] [int] NULL,
	[espacio_usado] [int] NULL,
	[dns] [varchar](100) NULL,
	[Id_Type] [int] NULL,
	[Id_SAS] [int] NULL,
	[Id_Power] [int] NULL,
	[Id_OS] [int] NULL,
	[Id_Responsable] [int] NULL,
	[Id_Zone] [int] NULL,
	[Id_Aplication] [int] NULL,
	[Id_Dbserver] [int] NULL,
	[Id_Connection_state] [int] NULL,
	[contingencia] [varchar](500) NULL,
	[observaciones] [varchar](500) NULL,
 CONSTRAINT [PK_servers] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[type]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[type](
	[Id_Type] [int] IDENTITY(1,1) NOT NULL,
	[Name_Type] [varchar](100) NULL,
 CONSTRAINT [PK_type] PRIMARY KEY CLUSTERED 
(
	[Id_Type] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[vulnera]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[vulnera](
	[id_vul] [int] IDENTITY(1,1) NOT NULL,
	[IP] [varchar](100) NULL,
	[Servidor] [varchar](100) NULL,
	[EstadoRiesgo] [varchar](100) NULL,
	[SeveridadRiesgo] [varchar](100) NULL,
	[Protocolo] [varchar](100) NULL,
	[Puerto] [int] NULL,
	[Responsable] [varchar](200) NULL,
	[AreaResponsable] [varchar](200) NULL,
	[TipoAmenaza] [varchar](200) NULL,
	[Solucion] [varchar](500) NULL,
	[Descripcion] [varchar](500) NULL,
	[PlanAccion] [varchar](500) NULL,
	[Evidencias] [varchar](500) NULL,
	[Observaciones] [varchar](500) NULL,
	[FechaEstimadaCierre] [date] NULL,
	[FechaEstimadaCierreProyecto] [date] NULL,
	[NumeroProyecto] [int] NULL,
	[activo] [int] NULL,
 CONSTRAINT [PK_vulnera] PRIMARY KEY CLUSTERED 
(
	[id_vul] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[zone]    Script Date: 27/02/2019 10:47:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[zone](
	[Id_Zone] [int] IDENTITY(1,1) NOT NULL,
	[Name_Zone] [varchar](100) NULL,
 CONSTRAINT [PK_zone] PRIMARY KEY CLUSTERED 
(
	[Id_Zone] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[servers]  WITH CHECK ADD  CONSTRAINT [FK_servers_aplication] FOREIGN KEY([Id_Aplication])
REFERENCES [dbo].[aplication] ([Id_Aplication])
GO
ALTER TABLE [dbo].[servers] CHECK CONSTRAINT [FK_servers_aplication]
GO
ALTER TABLE [dbo].[servers]  WITH CHECK ADD  CONSTRAINT [FK_servers_connection] FOREIGN KEY([Id_Connection_state])
REFERENCES [dbo].[connection] ([Id_Connection_state])
GO
ALTER TABLE [dbo].[servers] CHECK CONSTRAINT [FK_servers_connection]
GO
ALTER TABLE [dbo].[servers]  WITH CHECK ADD  CONSTRAINT [FK_servers_db_server] FOREIGN KEY([Id_Dbserver])
REFERENCES [dbo].[db_server] ([Id_Dbserver])
GO
ALTER TABLE [dbo].[servers] CHECK CONSTRAINT [FK_servers_db_server]
GO
ALTER TABLE [dbo].[servers]  WITH CHECK ADD  CONSTRAINT [FK_servers_os] FOREIGN KEY([Id_OS])
REFERENCES [dbo].[os] ([Id_OS])
GO
ALTER TABLE [dbo].[servers] CHECK CONSTRAINT [FK_servers_os]
GO
ALTER TABLE [dbo].[servers]  WITH CHECK ADD  CONSTRAINT [FK_servers_pci] FOREIGN KEY([Id_SAS])
REFERENCES [dbo].[pci] ([Id_SAS])
GO
ALTER TABLE [dbo].[servers] CHECK CONSTRAINT [FK_servers_pci]
GO
ALTER TABLE [dbo].[servers]  WITH CHECK ADD  CONSTRAINT [FK_servers_power] FOREIGN KEY([Id_Power])
REFERENCES [dbo].[power] ([Id_Power])
GO
ALTER TABLE [dbo].[servers] CHECK CONSTRAINT [FK_servers_power]
GO
ALTER TABLE [dbo].[servers]  WITH CHECK ADD  CONSTRAINT [FK_servers_responsable] FOREIGN KEY([Id_Responsable])
REFERENCES [dbo].[responsable] ([Id_Responsable])
GO
ALTER TABLE [dbo].[servers] CHECK CONSTRAINT [FK_servers_responsable]
GO
ALTER TABLE [dbo].[servers]  WITH CHECK ADD  CONSTRAINT [FK_servers_type] FOREIGN KEY([Id_Type])
REFERENCES [dbo].[type] ([Id_Type])
GO
ALTER TABLE [dbo].[servers] CHECK CONSTRAINT [FK_servers_type]
GO
ALTER TABLE [dbo].[servers]  WITH CHECK ADD  CONSTRAINT [FK_servers_zone] FOREIGN KEY([Id_Zone])
REFERENCES [dbo].[zone] ([Id_Zone])
GO
ALTER TABLE [dbo].[servers] CHECK CONSTRAINT [FK_servers_zone]
GO
