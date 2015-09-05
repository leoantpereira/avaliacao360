SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `avaliacao360` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `avaliacao360` ;

-- -----------------------------------------------------
-- Table `avaliacao360`.`cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`cidade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `estado` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao360`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`endereco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `logradouro` VARCHAR(200) NOT NULL,
  `numero` VARCHAR(10) NOT NULL,
  `complemento` VARCHAR(10) NULL,
  `bairro` VARCHAR(100) NOT NULL,
  `cep` VARCHAR(8) NOT NULL,
  `cidade_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_endereco_cidade1_idx` (`cidade_id` ASC),
  CONSTRAINT `fk_endereco_cidade1`
    FOREIGN KEY (`cidade_id`)
    REFERENCES `avaliacao360`.`cidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao360`.`empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`empresa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cnpj` VARCHAR(14) NOT NULL,
  `razaoSocial` VARCHAR(200) NOT NULL,
  `nomeFantasia` VARCHAR(200) NOT NULL,
  `telefone01` VARCHAR(11) NULL,
  `telefone02` VARCHAR(11) NULL,
  `email` VARCHAR(100) NULL,
  `endereco_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_empresa_endereco1_idx` (`endereco_id` ASC),
  CONSTRAINT `fk_empresa_endereco1`
    FOREIGN KEY (`endereco_id`)
    REFERENCES `avaliacao360`.`endereco` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao360`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`funcionario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `permissao` INT(2) NOT NULL,
  `foto` VARCHAR(100) NULL,
  `empresa_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_funcionario_empresa1_idx` (`empresa_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_funcionario_empresa1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `avaliacao360`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao360`.`questionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`questionario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(500) NOT NULL,
  `empresa_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_questionario_empresa1_idx` (`empresa_id` ASC),
  CONSTRAINT `fk_questionario_empresa1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `avaliacao360`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao360`.`questao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`questao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pergunta` VARCHAR(500) NOT NULL,
  `alternativa01` VARCHAR(500) NOT NULL,
  `alternativa02` VARCHAR(500) NOT NULL,
  `alternativa03` VARCHAR(500) NULL,
  `alternativa04` VARCHAR(500) NULL,
  `alternativa05` VARCHAR(500) NULL,
  `alternativaCorreta` VARCHAR(1) NOT NULL,
  `resposta` VARCHAR(500) NOT NULL,
  `questionario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_questao_questionario1_idx` (`questionario_id` ASC),
  CONSTRAINT `fk_questao_questionario1`
    FOREIGN KEY (`questionario_id`)
    REFERENCES `avaliacao360`.`questionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao360`.`avaliacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`avaliacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idAvaliador` INT NOT NULL,
  `questionario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_avaliacao_funcionario2_idx` (`idAvaliador` ASC),
  INDEX `fk_avaliacao_questionario1_idx` (`questionario_id` ASC),
  CONSTRAINT `fk_avaliacao_funcionario2`
    FOREIGN KEY (`idAvaliador`)
    REFERENCES `avaliacao360`.`funcionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_avaliacao_questionario1`
    FOREIGN KEY (`questionario_id`)
    REFERENCES `avaliacao360`.`questionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao360`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`endereco` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `logradouro` VARCHAR(200) NOT NULL,
  `numero` VARCHAR(10) NOT NULL,
  `complemento` VARCHAR(10) NULL,
  `bairro` VARCHAR(100) NOT NULL,
  `cep` VARCHAR(8) NOT NULL,
  `cidade_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_endereco_cidade1_idx` (`cidade_id` ASC),
  CONSTRAINT `fk_endereco_cidade1`
    FOREIGN KEY (`cidade_id`)
    REFERENCES `avaliacao360`.`cidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao360`.`departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`departamento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` VARCHAR(500) NULL,
  `empresa_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_departamento_empresa1_idx` (`empresa_id` ASC),
  CONSTRAINT `fk_departamento_empresa1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `avaliacao360`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao360`.`funcionario_has_departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`funcionario_has_departamento` (
  `funcionario_id` INT NOT NULL,
  `departamento_id` INT NOT NULL,
  PRIMARY KEY (`funcionario_id`, `departamento_id`),
  INDEX `fk_funcionario_has_departamento_departamento1_idx` (`departamento_id` ASC),
  INDEX `fk_funcionario_has_departamento_funcionario1_idx` (`funcionario_id` ASC),
  CONSTRAINT `fk_funcionario_has_departamento_funcionario1`
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `avaliacao360`.`funcionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_funcionario_has_departamento_departamento1`
    FOREIGN KEY (`departamento_id`)
    REFERENCES `avaliacao360`.`departamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `avaliacao360`.`avaliacao_has_funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacao360`.`avaliacao_has_funcionario` (
  `idAvaliacao` INT NOT NULL,
  `idFuncAvaliado` INT NOT NULL,
  `idQuestao` INT NOT NULL,
  `resposta` VARCHAR(1) NULL,
  `dataHora` DATETIME NULL,
  PRIMARY KEY (`idAvaliacao`, `idFuncAvaliado`, `idQuestao`),
  INDEX `fk_avaliacao_has_funcionario_funcionario1_idx` (`idFuncAvaliado` ASC),
  INDEX `fk_avaliacao_has_funcionario_avaliacao1_idx` (`idAvaliacao` ASC),
  INDEX `fk_avaliacao_has_funcionario_questao1_idx` (`idQuestao` ASC),
  CONSTRAINT `fk_avaliacao_has_funcionario_avaliacao1`
    FOREIGN KEY (`idAvaliacao`)
    REFERENCES `avaliacao360`.`avaliacao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_avaliacao_has_funcionario_funcionario1`
    FOREIGN KEY (`idFuncAvaliado`)
    REFERENCES `avaliacao360`.`funcionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_avaliacao_has_funcionario_questao1`
    FOREIGN KEY (`idQuestao`)
    REFERENCES `avaliacao360`.`questao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
