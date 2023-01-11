-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2023 a las 00:33:55
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cat_ca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblbitacora`
--

CREATE TABLE `tblbitacora` (
  `idBitacora` int(11) NOT NULL,
  `Asset` varchar(12) DEFAULT NULL,
  `TipoSalida` varchar(50) DEFAULT NULL,
  `Comentarios` text DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT NULL,
  `FechaAlarma` datetime DEFAULT NULL,
  `Ubicacion` text DEFAULT NULL,
  `Planta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblbitacora`
--

INSERT INTO `tblbitacora` (`idBitacora`, `Asset`, `TipoSalida`, `Comentarios`, `FechaRegistro`, `FechaAlarma`, `Ubicacion`, `Planta`) VALUES
(1, 'CFM4266-053', '1', 'se ahra mantenimiento test', '2023-01-11 17:17:29', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblca`
--

CREATE TABLE `tblca` (
  `idCA` int(11) NOT NULL,
  `Asset` varchar(12) NOT NULL,
  `Description` varchar(70) NOT NULL,
  `SerialNumber` varchar(18) NOT NULL,
  `TagEpc` varchar(24) NOT NULL,
  `TagSite` varchar(24) NOT NULL,
  `Inventory` varchar(1) NOT NULL,
  `TagSiteFound` varchar(24) NOT NULL,
  `DateInventory` datetime NOT NULL,
  `Service001` varchar(10) NOT NULL,
  `Service002` varchar(10) NOT NULL,
  `Service003` varchar(10) NOT NULL,
  `Service004` varchar(10) NOT NULL,
  `Service005` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblca`
--

INSERT INTO `tblca` (`idCA`, `Asset`, `Description`, `SerialNumber`, `TagEpc`, `TagSite`, `Inventory`, `TagSiteFound`, `DateInventory`, `Service001`, `Service002`, `Service003`, `Service004`, `Service005`) VALUES
(1, 'CFB606      ', 'NA                                                                    ', '', '', '', '', '', '2016-07-14 00:00:00', '', '3', 'C06', '', ''),
(2, 'CFM4266-053 ', 'SET OF CABLES FOR ELECTRICAL CONNECTIONS                              ', '', '', '', '', '', '2000-01-01 00:00:00', '', '3', 'D11', '', ''),
(3, 'CFB607      ', 'NA                                                                    ', '', '', '', '', '', '2016-07-14 00:00:00', '', '3', 'C06', '', ''),
(4, 'CFM4266-068 ', 'PRESS STRUCTURE AND TABLE FOR ASSY CELL                               ', '', '', '', '', '', '2000-01-01 00:00:00', '', '3', 'D11', '', ''),
(5, 'CFM4266-070 ', 'PRESS ARM                                                             ', '', '', '', '', '', '2000-01-01 00:00:00', '', '3', 'D11', '', ''),
(6, 'CFB608-000  ', 'ALIGN WORK STATIONS                                                   ', '', '', '', '', '', '2016-07-14 00:00:00', '', '3', 'D07', '', ''),
(7, 'CFM4266-075 ', '4 TABLES FOR FIXTURE                                                  ', '', '', '', '', '', '2000-01-01 00:00:00', '', '3', 'D11', '', ''),
(8, 'CFM4269-001 ', 'FIRE PROTECTION SYSTEM FOR BOOTH                                      ', '', '', '', '', '', '2016-06-22 00:00:00', '', '3', 'B11', '', ''),
(9, 'CFB609      ', 'NA                                                                    ', '', '', '', '', '', '2016-07-14 00:00:00', '', '3', 'D07', '', ''),
(10, 'CFB630      ', 'FULL FICM REPAIR BENCH                                                ', '', '', '', '', '', '2016-07-14 00:00:00', '', '3', 'C06', '', ''),
(11, 'CFB631      ', 'FULL FICM REPAIR BENCH                                                ', '', '', '', '', '', '2016-06-22 00:00:00', '', '3', 'C05', '', ''),
(12, 'CFM036      ', 'FILTERED MACHINE - EXTRACTORA DE VAPORES MICROZONE                    ', '', '', '', '', '', '2016-07-14 00:00:00', '', '1', 'C04', '', ''),
(13, 'CFM623      ', 'BALANCED AIR FUME HOODS                                               ', '', '', '', '', '', '2000-01-01 00:00:00', '', '1', 'D05', '', ''),
(14, 'CFM636      ', 'MINI-MEGATESTER                                                       ', '', '', '', '', '', '2016-07-14 00:00:00', '', '1', 'D05', '', ''),
(15, 'CFM637      ', 'EOL TESTER                                                            ', '', '', '', '', '', '2015-07-23 00:00:00', '', '1', 'C05', '', ''),
(16, 'CFM638      ', 'EOL TESTER                                                            ', '', '', '', '', '', '2000-01-01 00:00:00', '', '1', 'C05', '', ''),
(17, 'CFM639      ', 'EOL TESTER                                                            ', '', '', '', '', '', '2016-07-14 00:00:00', '', '1', 'C05', '', ''),
(18, 'CFM640      ', 'EOL TESTER                                                            ', '', '', '', '', '', '2016-07-14 00:00:00', '', '1', 'C04', '', ''),
(19, 'CFB143      ', 'EOL TESTER                                                            ', '', '', '', '', '', '2016-03-15 00:00:00', '', '1', 'C06', '', ''),
(20, 'CFB610      ', 'NA                                                                    ', '', '', '', '', '', '2016-07-14 00:00:00', '', '1', 'C05', '', ''),
(21, 'CFM641      ', 'TEST CHAMBER NAVISTAR                                                 ', '', '', '', '', '', '2000-01-01 00:00:00', '', '1', 'C06', '', ''),
(22, 'CFM642      ', 'SERIES CONTINUOS OVEN                                                 ', '', '', '', '', '', '2016-07-14 00:00:00', '', '2', 'C05', '', ''),
(23, 'CFM643      ', 'TOOL:ASG-SD2500-10PLL-SY-NC TORQUE SYSTEM SD2500-50PL                 ', '', '', '', '', '', '2016-07-14 00:00:00', '', '2', 'C05', '', ''),
(24, 'CFM644      ', 'TOOL:ASG-SD2500-10PLL-SY-NC TORQUE SYSTEM CT-2500                     ', '', '', '', '', '', '2016-07-14 00:00:00', '', '2', 'D05', '', ''),
(25, 'CFM652      ', 'TEMPERATURE CHAMBER                                                   ', '', '', '', '', '', '2016-07-14 00:00:00', '', '2', 'D05', '', ''),
(26, 'CFM664      ', 'IRPL650 RESOLDERING MACHINE                                           ', '', '', '', '', '', '2000-01-01 00:00:00', '', '2', 'C05', '', ''),
(27, 'CFM669      ', 'OVEN CHAMBER                                                          ', '', '', '', '', '', '2000-01-01 00:00:00', '', '2', 'A04', '', ''),
(28, 'CFM670      ', 'OVEN CHAMBER                                                          ', '', '', '', '', '', '2016-07-14 00:00:00', '', '2', 'A04', '', ''),
(29, 'CFB5037     ', 'WORKBENCHES FOR CLEANING PROCESS                                      ', '', '', '', '', '', '2016-07-14 00:00:00', '', '2', 'B04', '', ''),
(30, 'CFB5038     ', 'DISASSEMBLY WORKBENCHES                                               ', '', '', '', '', '', '2016-07-14 00:00:00', '', '2', 'C05', '', ''),
(31, 'CFM8007     ', 'LAPMASTER SS-48H M10010                                               ', '', '', '', '', '', '2016-02-17 00:00:00', '', '2', 'A04', '', ''),
(32, 'CFM8070     ', 'PAINT BOOTH. GLOBEL FINISHING SOLUTIONS M10290                        ', '', '', '', '', '', '2016-02-17 00:00:00', '', '2', 'C05', '', ''),
(33, 'CFM8216     ', 'HURCO / CNC CENTER M10011                                             ', '', '', '', '', '', '2016-07-14 00:00:00', '', '2', 'C04', '', ''),
(34, 'CFM8220     ', 'BLANCHARD GRINDER  M10204                                             ', '', '', '', '', '', '2016-02-17 00:00:00', '', '2', 'C05', '', ''),
(35, 'CFM8262     ', 'ENERPAC PRESS RC1012 M10410                                           ', '', '', '', '', '', '2016-02-17 00:00:00', '', '2', 'D05', '', ''),
(36, 'CFM8264     ', 'MAGNUS MIJI LIFT M10452                                               ', '', '', '', '', '', '2016-02-17 00:00:00', '', '4', 'C05', '', ''),
(37, 'CFM8266     ', 'STANLEY TORQUE GUN  M10642/43/44                                      ', '', '', '', '', '', '2016-02-17 00:00:00', '', '4', 'A04', '', ''),
(38, 'CFM8273     ', 'LAPPER M6147                                                          ', '', '', '', '', '', '2000-01-01 00:00:00', '', '4', 'A04', '', ''),
(39, 'CFM8275     ', 'U-JOINT TESTER STAND  M6156                                           ', '', '', '', '', '', '2016-02-17 00:00:00', '', '4', 'B04', '', ''),
(40, 'CFB612-000  ', 'ALIGN WORK STATIONS                                                   ', '', '', '', '', '', '2016-07-14 00:00:00', '', '4', 'C05', '', ''),
(41, 'CFM8276     ', 'HONING MACHINE M6160                                                  ', '', '', '', '', '', '2000-01-01 00:00:00', '', '4', 'A04', '', ''),
(42, 'CFM8277     ', 'ENERPAC PRESS RC1012 M6162                                            ', '', '', '', '', '', '2016-02-17 00:00:00', '', '4', 'C05', '', ''),
(43, 'CFM8278     ', 'TM BARREL/PLATE LAPPER  M6168                                         ', '', '', '', '', '', '2016-02-17 00:00:00', '', '4', 'C04', '', ''),
(44, 'CFM8312     ', 'PROCECO PASS THRU WASHER M10216                                       ', '', '', '', '', '', '2016-02-17 00:00:00', '', '4', 'C05', '', ''),
(45, 'CFM8401     ', 'CNC MORI SEIKIM10060                                                  ', '', '', '', '', '', '2016-02-17 00:00:00', '', '4', 'A03', '', ''),
(46, 'CFM8405     ', 'SMALL PASS THROUGH WASHER M10207                                      ', '', '', '', '', '', '2000-01-01 00:00:00', '', '4', 'A04', '', ''),
(47, 'CFB613-000  ', 'ALIGN WORK STATIONS                                                   ', '', '', '', '', '', '2016-07-14 00:00:00', '', '4', 'B05', '', ''),
(48, 'CFB628-000  ', 'NAVISTAR VISION SYSTEM                                                ', '', '', '', '', '', '2016-07-14 00:00:00', '', '4', 'C06', '', ''),
(49, 'CFB615      ', 'NA                                                                    ', '', '', '', '', '', '2016-07-14 00:00:00', '', '4', 'C07', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcomentariosalarma`
--

CREATE TABLE `tblcomentariosalarma` (
  `idComentarioAlarma` int(11) NOT NULL,
  `Asset` varchar(12) NOT NULL,
  `Comentario` text NOT NULL,
  `FechaRegistro` varchar(50) NOT NULL,
  `FechaAlarma` datetime NOT NULL,
  `Ubicacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcorreo`
--

CREATE TABLE `tblcorreo` (
  `idCorreo` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `ApellidoP` varchar(50) NOT NULL,
  `ApellidoM` varchar(50) NOT NULL,
  `CorreoElectronico` varchar(100) NOT NULL,
  `Estado` varchar(1) NOT NULL,
  `Planta` varchar(1) NOT NULL,
  `Cargo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblcorreo`
--

INSERT INTO `tblcorreo` (`idCorreo`, `Nombre`, `ApellidoP`, `ApellidoM`, `CorreoElectronico`, `Estado`, `Planta`, `Cargo`) VALUES
(1, 'Howard Adair', 'Galvez', 'Gobin', 'hgalvez@astlix.com', '1', '1', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblhandhelds`
--

CREATE TABLE `tblhandhelds` (
  `idHandheld` int(11) NOT NULL,
  `MAC` varchar(50) NOT NULL,
  `Modelo` varchar(10) NOT NULL,
  `Marca` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblhandhelds`
--

INSERT INTO `tblhandhelds` (`idHandheld`, `MAC`, `Modelo`, `Marca`) VALUES
(2, '12345678', 'hh', 'impinj');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblreaders`
--

CREATE TABLE `tblreaders` (
  `idReader` int(11) NOT NULL,
  `MAC` varchar(20) NOT NULL,
  `DNSName` varchar(25) NOT NULL,
  `Planta` varchar(5) NOT NULL,
  `Columna` varchar(5) NOT NULL,
  `IPAddress` varchar(20) NOT NULL,
  `SubnetMask` varchar(20) NOT NULL,
  `Gateway` varchar(20) NOT NULL,
  `App` varchar(10) NOT NULL,
  `TxPower` varchar(5) NOT NULL,
  `Marca` varchar(10) NOT NULL,
  `Modelo` varchar(20) NOT NULL,
  `Locacion` varchar(50) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblreaders`
--

INSERT INTO `tblreaders` (`idReader`, `MAC`, `DNSName`, `Planta`, `Columna`, `IPAddress`, `SubnetMask`, `Gateway`, `App`, `TxPower`, `Marca`, `Modelo`, `Locacion`, `Estado`, `Fecha`) VALUES
(1, '00162510C8FA', 'rfid01.mw.na.astlix.com', 'f3', 'H', '192.168.100.21', '255.255.255.0', '10.100.3.1', 'LMTGCR001', '4.00', 'impinj', 'Speedway Revolution', 'Cortina Sur R&E (G9)', 0, '2023-01-10 22:59:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbluser`
--

CREATE TABLE `tbluser` (
  `idUser` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserEmail` varchar(100) NOT NULL,
  `UserRole` varchar(1) NOT NULL,
  `FechaCreacion` date NOT NULL,
  `cuenta` varchar(10) NOT NULL,
  `UserNickname` varchar(50) NOT NULL,
  `UserPassword` varchar(100) NOT NULL,
  `FechaUpdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbluser`
--

INSERT INTO `tbluser` (`idUser`, `UserName`, `UserEmail`, `UserRole`, `FechaCreacion`, `cuenta`, `UserNickname`, `UserPassword`, `FechaUpdate`) VALUES
(1, 'root', 'hgalvez@astlix.com', '1', '2023-01-10', 'activa', 'root', '@impinj10', '0000-00-00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblbitacora`
--
ALTER TABLE `tblbitacora`
  ADD PRIMARY KEY (`idBitacora`);

--
-- Indices de la tabla `tblca`
--
ALTER TABLE `tblca`
  ADD PRIMARY KEY (`idCA`);

--
-- Indices de la tabla `tblcomentariosalarma`
--
ALTER TABLE `tblcomentariosalarma`
  ADD PRIMARY KEY (`idComentarioAlarma`);

--
-- Indices de la tabla `tblcorreo`
--
ALTER TABLE `tblcorreo`
  ADD PRIMARY KEY (`idCorreo`);

--
-- Indices de la tabla `tblhandhelds`
--
ALTER TABLE `tblhandhelds`
  ADD PRIMARY KEY (`idHandheld`);

--
-- Indices de la tabla `tblreaders`
--
ALTER TABLE `tblreaders`
  ADD PRIMARY KEY (`idReader`);

--
-- Indices de la tabla `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblbitacora`
--
ALTER TABLE `tblbitacora`
  MODIFY `idBitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblca`
--
ALTER TABLE `tblca`
  MODIFY `idCA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `tblcomentariosalarma`
--
ALTER TABLE `tblcomentariosalarma`
  MODIFY `idComentarioAlarma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblcorreo`
--
ALTER TABLE `tblcorreo`
  MODIFY `idCorreo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblhandhelds`
--
ALTER TABLE `tblhandhelds`
  MODIFY `idHandheld` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblreaders`
--
ALTER TABLE `tblreaders`
  MODIFY `idReader` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
