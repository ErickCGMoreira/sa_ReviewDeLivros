-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Set-2022 às 15:22
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sa_reviewlivros`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL,
  `ISBN` varchar(30) NOT NULL,
  `title` varchar(200) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `pdate` date NOT NULL,
  `price` float NOT NULL,
  `genre` varchar(100) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `synopsis` varchar(1000) NOT NULL,
  `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`idproduct`, `ISBN`, `title`, `author`, `publisher`, `pdate`, `price`, `genre`, `tags`, `synopsis`, `img`) VALUES
(1, '9788555342080', 'Heartstopper, volume 1', 'Alice Oseman', 'Grupo Companhia Das Letras', '2019-02-07', 64.9, 'Romance', 'LGBTQIA+&MLM&Gay&Drama&Romance&School&Queer', 'Charlie Spring e Nick Nelson não têm quase nada em comum. Charlie é um aluno dedicado e bastante inseguro por conta do bullying que sofre no colégio desde que se assumiu gay. Já Nick é superpopular, especialmente querido por ser um ótimo jogador de rúgbi. Quando os dois passam a sentar um ao lado do outro toda manhã, uma amizade intensa se desenvolve, e eles ficam cada vez mais próximos.', 'uploads\\8129HX+5JGL.jpg'),
(2, '9786559212835', 'Maus', 'Art Spiegelman', 'Grupo Companhia Das Letras', '2005-06-24', 70, 'Biografia', 'HQ&Quadrinhos&Graphic Novel&Segunda Guerra&Guerra&Guerra mundial&Holocausto', 'Sinopse. Maus (\"rato\", em alemão) é a história de Vladek Spiegelman, judeu polonês que sobreviveu ao campo de concentração de Auschwitz, narrada por ele próprio ao filho Art. O livro é conside', 'uploads\\916IgqQ-54L.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `review`
--

CREATE TABLE `review` (
  `idreview` int(11) NOT NULL,
  `idproduct` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `text` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `review`
--

INSERT INTO `review` (`idreview`, `idproduct`, `iduser`, `score`, `text`) VALUES
(1, 1, 2, 5, 'MT BOM! O livro é uma obra prima, mt engraçado.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`iduser`, `name`, `email`, `password`) VALUES
(1, 'ADMIN', 'adm@adorolivros.com', '6ab667c987e4f6a680b1e3f40e79706753e8ebe210e3a07f8ca7fae1b7ee725b'),
(2, 'Erick Cristiano Gomes Moreira', '0000874876@senaimgaluno.com.br', '44c514cbfa5a05820e3d2eb34e59802d65ec8470c8a520271553d1a89143c25a'),
(3, 'luis', 'luis@email', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idproduct`),
  ADD UNIQUE KEY `idproduct_UNIQUE` (`idproduct`),
  ADD UNIQUE KEY `productcol_UNIQUE` (`ISBN`);

--
-- Índices para tabela `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idreview`),
  ADD UNIQUE KEY `idreview_UNIQUE` (`idreview`),
  ADD KEY `fk_review_product_idx` (`idproduct`),
  ADD KEY `fk_review_user1_idx` (`iduser`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `iduser_UNIQUE` (`iduser`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `idproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `review`
--
ALTER TABLE `review`
  MODIFY `idreview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_product` FOREIGN KEY (`idproduct`) REFERENCES `product` (`idproduct`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_review_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
