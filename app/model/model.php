<?php
require_once 'config.php';
    class Model {
        protected $db;
        function __construct() {
          $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
          $this->deploy();
        }
        function deploy() {
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();
            if(count($tables)==0) {
                $sql =<<<END

CREATE TABLE `admins` (
  `Id` int(11) NOT NULL,
  `nombre` varchar(99) NOT NULL,
  `contraseña` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`Id`, `nombre`, `contraseña`) VALUES
(1, 'webadmin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `heladerias`
--

CREATE TABLE `heladerias` (
  `ID_Heladerias` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Fecha_Asociacion` date NOT NULL,
  `Foto_Heladerias` varchar(2083) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `heladerias`
--

INSERT INTO `heladerias` (`ID_Heladerias`, `Nombre`, `Direccion`, `Fecha_Asociacion`, `Foto_Heladerias`) VALUES
(1, 'Grido', 'Av. Perón 1399, B7000 Tandil, Provincia de Buenos Aires', '2012-12-21', 'https://www.negociosypymes.com/wp-content/uploads/2022/02/Grido-local-helados.jpg'),
(2, 'Iglu', 'Av. España 975, B7000 Tandil, Provincia de Buenos Aires', '2023-04-11', 'https://media-cdn.tripadvisor.com/media/photo-s/0e/4e/57/7f/iglu-suarez.jpg'),
(3, 'Helados Chinos', '9 de Julio 992, B7000 Tandil, Provincia de Buenos Aires', '2016-06-14', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRR9965a-I2kI6NMaqtEU9FtkfUhxC6QX8D0w&s');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `helados`
--

CREATE TABLE `helados` (
  `ID_Helados` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Subcategorias` varchar(30) NOT NULL,
  `Peso` int(100) NOT NULL,
  `Precio_Costo` double NOT NULL,
  `Precio_Venta` double NOT NULL,
  `Foto_Helados` varchar(2083) NOT NULL,
  `ID_Heladerias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `helados`
--

INSERT INTO `helados` (`ID_Helados`, `Nombre`, `Subcategorias`, `Peso`, `Precio_Costo`, `Precio_Venta`, `Foto_Helados`, `ID_Heladerias`) VALUES
(1, 'Chocolate', 'Chocolate', 20, 100000, 150000, 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/Vegan_Double_Chocolate_Brownie_Chunk_Ice_Cream_%284869832969%29.jpg/273px-Vegan_Double_Chocolate_Brownie_Chunk_Ice_Cream_%284869832969%29.jpg', 1),
(2, 'Dulce De Leche', 'Dulce De Leche', 20, 120000, 190000, 'https://cdn.discordapp.com/attachments/749066187085971526/1294824196102295594/helad_PfzL0wqTRnZyNObMleAvpmFYVSHdj6-1024x683.png?ex=670c6a81&is=670b1901&hm=c5b75edcce83dd7a7f3007a23fe584725ba7c5e91e0939ad507a2a14cedac79d&', 2),
(3, 'Vainilla', 'Crema', 20, 110000, 170000, 'https://heladoscaseros.com/wp-content/uploads/2017/09/helado-vainilla-casero.jpg', 3),
(4, 'Frutilla', 'Frutales', 10, 50000, 75000, 'https://imagenes.montevideo.com.uy/imgnoticias/201303/_W880_H495/397189.jpg', 1),
(5, 'Menta Granizada', 'Crema', 15, 90000, 135000, 'https://i.pinimg.com/564x/6f/b1/bd/6fb1bdf2f4d8f3dc2e856fd8d9125599.jpg', 2),
(7, 'Banana Split', 'Frutales', 5, 27000, 47750, 'https://acdn.mitiendanube.com/stores/001/292/222/products/banana-split1-2c774be303a974cf5c16008834050746-1024-1024.webp', 3),
(8, 'Chocolate Blanco', 'Chocolate', 30, 150000, 25000, 'https://static.wikia.nocookie.net/super-helados/images/7/79/Chocolate_blanco.jpg/revision/latest?cb=20211020193911&path-prefix=es', 1),
(9, 'Marroc', 'Crema Especial', 12, 66000, 99000, 'https://scontent.fmdq6-1.fna.fbcdn.net/v/t1.6435-9/83563917_620800195345711_6448858343715897344_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=833d8c&_nc_ohc=YPpkpUVL0CIQ7kNvgEzT59N&_nc_ht=scontent.fmdq6-1.fna&_nc_gid=AVGpsNRcbTKHjftMShxoF18&oh=00_AYDgV7IpGlJyOZTr-T7sp4biRTdeaHiFuMpApQ6fK6TdYg&oe=6732954B', 3),
(10, 'Crema Americana', 'Crema', 18, 90000, 135000, 'https://cdn0.recetasgratis.net/es/posts/3/2/5/helado_de_crema_americana_tradicional_50523_orig.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD UNIQUE KEY `Id` (`Id`);

--
-- Indices de la tabla `heladerias`
--
ALTER TABLE `heladerias`
  ADD PRIMARY KEY (`ID_Heladerias`),
  ADD UNIQUE KEY `Nombre` (`Nombre`),
  ADD UNIQUE KEY `Direccion` (`Direccion`);

--
-- Indices de la tabla `helados`
--
ALTER TABLE `helados`
  ADD PRIMARY KEY (`ID_Helados`),
  ADD KEY `ID_Heladerias` (`ID_Heladerias`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `heladerias`
--
ALTER TABLE `heladerias`
  MODIFY `ID_Heladerias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `helados`
--
ALTER TABLE `helados`
  MODIFY `ID_Helados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `helados`
--
ALTER TABLE `helados`
  ADD CONSTRAINT `helados_ibfk_1` FOREIGN KEY (`ID_Heladerias`) REFERENCES `heladerias` (`ID_Heladerias`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
END;
$this->db->query($sql);
        }
    }
}
?>
