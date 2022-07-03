USE projeto;
CREATE TABLE instituicao
(
  inst_acronimo VARCHAR(20) NOT NULL, /* Acr�nimo da institui��o */
  inst_id  INT IDENTITY(1,1) NOT NULL, /* ID da institui��o, auto-incrementado*/
  inst_distrito VARCHAR(200) NOT NULL, /* Distrito da institui��o */
  inst_nome VARCHAR(200) NOT NULL, /* Nome da institui��o */
  inst_tipo INT NOT NULL,/* 1 - publica  2 - privada  3 - individual */
  inst_parceira INT NOT NULL, /* Parceira? 1 - Sim 0 - N�o */
  PRIMARY KEY (inst_id)
);

CREATE TABLE utilizador
(
  u_nome VARCHAR(200) NOT NULL, /* Nome de utilizador */
  u_password VARCHAR(500) NOT NULL, /* Password do utilizador */
  u_email VARCHAR(200) NOT NULL, /* Email do utilizador */
  u_id INT IDENTITY(1,1) NOT NULL,/* ID do utilizador */
  u_membro INT NOT NULL,/* Membro? 1 - Sim 0 - N�o */
  u_tipo INT NOT NULL,/* Tipo de utilizador : 0 - (Qualquer um) 1 - (Utilizador com permiss�es moderadas) 2 - (Utilizador priviligeado) 3 - (Administrador) */
  u_funcao VARCHAR(200) NOT NULL,/* Fun��o do utilizador */
  nome VARCHAR(200) NOT NULL,/* Nome pr�prio do utilizador */
  PRIMARY KEY (u_id)
);

CREATE TABLE grupoTrabalho
(
  grp_id INT IDENTITY(1,1) NOT NULL, /* ID do grupo de trabalho */
  grp_desc VARCHAR(200) NOT NULL, /* Descri��o do grupo de trabalho */
  grp_nome VARCHAR(100) NOT NULL, /* Nome do grupo de trabalho */
  grp_acro VARCHAR(50) NOT NULL, /* Acr�nimo do grupo de trabalho */
  PRIMARY KEY (grp_id)
);

CREATE TABLE recurso
(
  rec_id INT IDENTITY(1,1) NOT NULL, /* ID do recurso */
  rec_designacao_pt VARCHAR(400) NOT NULL, /* Designa��o (pt) do recurso */
  rec_obs VARCHAR(400) NOT NULL, /* Observa��es do recurso */
  rec_designacao_en VARCHAR(400) NOT NULL, /* Designa��o do recurso */
  rec_custo FLOAT NOT NULL, /* Custo do recurso */
  PRIMARY KEY (rec_id)
);

CREATE TABLE dados
(
  dados_web VARCHAR(100) NOT NULL, /* P�gina web dos dados */
  rec_id INT NOT NULL, /* ID do recurso assinado */
  FOREIGN KEY (rec_id) REFERENCES recurso(rec_id)
);

CREATE TABLE produtos
(
  prod_nivel INT NOT NULL, /* N�vel de produto: 0,1,2,3 */
  prod_web VARCHAR(200) NOT NULL, /* P�gina web do produto */
  prod_tipo VARCHAR(4) NOT NULL, /* Tipo de produto */
  rec_id INT NOT NULL, /* ID do recurso assinado */
  FOREIGN KEY (rec_id) REFERENCES recurso(rec_id)
);

CREATE TABLE laboratorio
(
  lab_acronimo VARCHAR(30) NOT NULL, /* Acr�nimo do laborat�rio */
  lab_id INT IDENTITY(1,1) NOT NULL, /* ID do laborat�rio */
  lab_nome VARCHAR(300) NOT NULL, /* Nome do laborat�rio */
  inst_id INT NOT NULL, /* ID da institui��o a que o laborat�rio pertence */
  PRIMARY KEY (lab_id),
  FOREIGN KEY (inst_id) REFERENCES instituicao(inst_id)
);

CREATE TABLE formacao
(
  form_tipo VARCHAR(50) NOT NULL, /* Tipo de forma��o: Elearning, Presencial, ... */
  form_vagas INT NOT NULL, /* Vagas para a forma��o */
  rec_id INT NOT NULL, /* ID do recurso */
  FOREIGN KEY (rec_id) REFERENCES recurso(rec_id)
);

CREATE TABLE equipamentos
(
  eq_marca VARCHAR(200) NOT NULL, /* Marca do equipamento */
  eq_manuseio_terceiros VARCHAR(2) NOT NULL, /* Equipamento permite manuseio a terceiros? 1 - Sim 0 - N�o */
  eq_foto VARCHAR(400) NOT NULL, /* Foto do equipamento (url) */
  eq_modelo VARCHAR(200) NOT NULL, /* Modelo do equipamento */
  eq_n_serie INT NOT NULL, /* N� de s�rie do equipamento */
  eq_data_aq DATE NOT NULL, /* Data de aquisi��o do equipamento */
  eq_fornecedor VARCHAR(300) NOT NULL, /* Fornecedor do equipamento */
  eq_garantia DATE NOT NULL, /* Garantia do equipamento */
  eq_loc_hab VARCHAR(300) NOT NULL, /* Local habitual do equipamento */
  eq_cond_uso VARCHAR(2) NOT NULL, /* Condi��o de uso do equipaento */
  eq_mobilidade VARCHAR(300) NOT NULL, /*Mobilidade do equipamento: M�vel, Im�vel, Dif�cil de mover, Grande porte, ...*/
  eq_tipo_uso VARCHAR(2) NOT NULL, /* Tipo de uso do equipamento E - empr�stimo (De acordo com a tabela facultada) */
  eq_nome VARCHAR(200) NOT NULL, /* Nome do equipamento */
  eq_aq_C4G INT NOT NULL, /* Adquirido pelo C4G? 1 - Sim  0 - N�o */
  rec_id INT NOT NULL, /* ID do recurso */
  eq_zelador INT NOT NULL, /* Zelador do equipamento (utilizador da base de dados) */
  PRIMARY KEY (eq_n_serie),
  FOREIGN KEY (rec_id) REFERENCES recurso(rec_id),
  FOREIGN KEY (eq_zelador) REFERENCES utilizador(u_id)
);

CREATE TABLE nao_operacional
(
  op_razao VARCHAR(200) NOT NULL, /* Raz�o pela qual o equipamento n�o est� operacional */
  eq_n_serie INT NOT NULL, /* N� de s�rie do equipamento n�o operacional */
  FOREIGN KEY (eq_n_serie) REFERENCES equipamentos(eq_n_serie)
);

CREATE TABLE unidadeInvestigacao
(
  unid_id INT IDENTITY(1,1) NOT NULL, /* ID da unidade de investiga��o */
  unid_desc VARCHAR(200) NOT NULL, /* Descri��o da unidade de investiga��o */
  unid_nome VARCHAR(100) NOT NULL, /* Nome da unidade de investiga��o */
  unid_acro VARCHAR(50) NOT NULL, /* Acr�nimo da unidade de investiga��o */
  PRIMARY KEY (unid_id)
);

CREATE TABLE responsavel
(
  rec_id INT NOT NULL, /* ID do recurso em si */
  u_id INT NOT NULL, /* ID do respons�vel por um recurso */
  PRIMARY KEY (rec_id, u_id),
  FOREIGN KEY (rec_id) REFERENCES recurso(rec_id),
  FOREIGN KEY (u_id) REFERENCES utilizador(u_id)
);

CREATE TABLE disponibilizam
(
  lab_id INT NOT NULL, /* ID do laborat�rio que disponibiliza o recurso */
  rec_id INT NOT NULL, /* ID do recurso */
  PRIMARY KEY (lab_id, rec_id),
  FOREIGN KEY (lab_id) REFERENCES laboratorio(lab_id),
  FOREIGN KEY (rec_id) REFERENCES recurso(rec_id)
);

CREATE TABLE pertence
(
  lab_id INT NOT NULL, /* ID do laborat�rio a que o utilizador pertence */
  u_id INT NOT NULL, /* ID do utilizador */
  PRIMARY KEY (u_id),
  FOREIGN KEY (lab_id) REFERENCES laboratorio(lab_id),
  FOREIGN KEY (u_id) REFERENCES utilizador(u_id)
);


CREATE TABLE unidade_grupo
(
  unid_id INT NOT NULL, /* ID da Unidade de trabalho a que o grupo pertence */
  grp_id INT NOT NULL, /* ID do grupo de trabalho */
  PRIMARY KEY (unid_id, grp_id),
  FOREIGN KEY (unid_id) REFERENCES unidadeInvestigacao(unid_id),
  FOREIGN KEY (grp_id) REFERENCES grupoTrabalho(grp_id)
);

CREATE TABLE eq_grp_adeq
(
  eq_n_serie INT NOT NULL, /* ID do equipamento */
  grp_id INT NOT NULL, /* ID do grupo a que o equipamento � adequado */
  PRIMARY KEY (eq_n_serie, grp_id),
  FOREIGN KEY (eq_n_serie) REFERENCES equipamentos(eq_n_serie),
  FOREIGN KEY (grp_id) REFERENCES grupoTrabalho(grp_id)
);

CREATE TABLE rec_u /* O utilizador pode, por vezes funcionar como um recurso, por exemplo num servi�o com uma forma��o */
(
  rec_id INT NOT NULL, /* ID do recurso assinado */
  u_id INT NOT NULL, /* ID do utilizador utilizado como recurso */
  PRIMARY KEY (rec_id, u_id),
  FOREIGN KEY (rec_id) REFERENCES recurso(rec_id),
  FOREIGN KEY (u_id) REFERENCES utilizador(u_id)
);

CREATE TABLE linhasAcao
(
  linhas_id INT IDENTITY(1,1) NOT NULL,
  linhas_acro VARCHAR(50) NOT NULL,
  linhas_nome VARCHAR(200) NOT NULL,
  PRIMARY KEY (linhas_id)
);

CREATE TABLE pertence_grupo
(
  u_id INT NOT NULL,
  grp_id INT NOT NULL,
  PRIMARY KEY (u_id, grp_id),
  FOREIGN KEY (u_id) REFERENCES utilizador(u_id),
  FOREIGN KEY (grp_id) REFERENCES grupoTrabalho(grp_id)
);

CREATE TABLE servico
(
  servico_id INT IDENTITY(1,1) NOT NULL, /* ID do servi�o */
  servico_nome VARCHAR(300) NOT NULL, /* Nome do servi�o */
  servico_tipo VARCHAR(2) NOT NULL, /* Tipo de servi�o fornecido */
  servico_coord INT NOT NULL, /* ID do respons�vel pelo servi�o */
  PRIMARY KEY (servico_id),
  FOREIGN KEY (servico_coord) REFERENCES utilizador(u_id)
);

CREATE TABLE requerimento
(
  req_inicio DATE NOT NULL, /* Data de inicio do requerimento */
  req_fim DATE NOT NULL, /* Data de fim do requerimento */
  req_estado INT NOT NULL, /* Estado do requerimento: 0 - Ativo 1 - Inativo 2 - Suspenso 3 - � espera de permiss�o */
  req_id INT NOT NULL, /* ID do requerimento */
  req_requerendo INT NOT NULL, /* ID do requerendo (utilizador) */
  req_servico INT NOT NULL, /* ID do servi�o requerido */
  grp_id INT NOT NULL, /* ID do grupo de trabalho associado ao requerimento do servi�o */
  PRIMARY KEY (req_id),
  FOREIGN KEY (req_requerendo) REFERENCES utilizador(u_id),
  FOREIGN KEY (req_servico) REFERENCES servico(servico_id),
  FOREIGN KEY (grp_id) REFERENCES grupoTrabalho(grp_id)
);

CREATE TABLE incui
(
  servico_id INT NOT NULL, /* ID do servi�o */
  rec_id INT NOT NULL, /* ID dos recursos incluidos no servi�o */
  PRIMARY KEY (servico_id, rec_id),
  FOREIGN KEY (servico_id) REFERENCES servico(servico_id),
  FOREIGN KEY (rec_id) REFERENCES recurso(rec_id)
);

CREATE TABLE associado
(
  servico_id INT NOT NULL, /* ID do servi�o */
  grp_id INT NOT NULL, /* ID do grupo de trabalho associado a esse servi�o */
  PRIMARY KEY (servico_id, grp_id),
  FOREIGN KEY (servico_id) REFERENCES servico(servico_id),
  FOREIGN KEY (grp_id) REFERENCES grupoTrabalho(grp_id)
);

CREATE TABLE req_eq
(
  req_id INT NOT NULL, /* ID do requerimento */
  eq_n_serie INT NOT NULL, /* N� de s�rie dos equipamentos requeridos */
  PRIMARY KEY (eq_n_serie),
  FOREIGN KEY (req_id) REFERENCES requerimento(req_id),
  FOREIGN KEY (eq_n_serie) REFERENCES equipamentos(eq_n_serie)
);

CREATE TABLE linhas_grupo
(
  grp_id INT NOT NULL,
  linhas_id INT NOT NULL,
  PRIMARY KEY (grp_id, linhas_id),
  FOREIGN KEY (grp_id) REFERENCES grupoTrabalho(grp_id),
  FOREIGN KEY (linhas_id) REFERENCES linhasAcao(linhas_id)
);

BEGIN TRANSACTION
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('A-RAEGE-Az','Associa��o RAEGE A�ores','A�ores',1,1); /*A institui��o � parceira e p�blica*/
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('C4G','C4G - Collaboratory for Geosciences','Castelo Branco',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('DGT','Dire��o Geral do Territ�rio','Lisboa',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('FCUC','Faculdade de Ci�ncias da Universidade de Coimbra','Coimbra',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('FCUL','Faculdade de Ci�ncias da Universidade de Lisboa','Lisboa',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('FCUP','Faculdade de Ci�ncias da Universidade do Porto','Porto',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('FEUP','Faculdade de Engenharia do Porto','Porto',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('IPCB','Instituto Polit�cnico de Castelo Branco','Castelo Branco',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('IPP','Instituto Polit�cnico de Portalegre','Portalegre',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('IPMA','Instituto Portugu�s do Mar e da Atmosfera','Lisboa',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('IST-UL','Instituto Superior T�cnico-Universidade Lisboa','Lisboa',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('ISEL','Instituto Superior de Engenharia de Lisboa','Lisboa',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('INESC TEC','Instituto de Engenharia de Sistemas e Computadores, Tecnologia e Ci�ncia','Porto',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('IGOT-UL','Instituto de Geografia e Ordenamento do Territ�rio','Lisboa',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('LNEG','Laborat�rio Nacional de Energia e Geologia','Lisboa',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('UBI','Universidade da Beira Interior','Covilh�',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('UA','Universidade de Aveiro','Aveiro',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('UC','Universidade de Coimbra','Coimbra',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('UE','Universidade de �vora','�vora',1,1);
INSERT INTO instituicao (inst_acronimo,inst_nome,inst_distrito,inst_parceira,inst_tipo) VALUES ('UALG','Universidade do Algarve','Algarve',1,1);
COMMIT;

BEGIN TRANSACTION
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Centro de Estudos Geol�gicos e Mineiros do Alentejo','CEGMA',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Dinamica da Litosfera','DL',1);/*ERRO AQUI*/
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio da Unidade de Ci�ncia e Tecnologia Mineral','LUCTM',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Analises Qu�micas por Raios-X','LAQR-X',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de An�lises Qu�micas','LAQ',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Caracteriza��o de Materiais Geol�gicos','LCMG',6);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Dete��o Remota','LDR',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Dete��o Remota, An�lise e Modela��o Geogr�fica','GEOMODLAB',15);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Equipamentos Port�teis, DRX Port�til e PIMA','LEPDRXPPIMA',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Estudos dos Efeitos do Rad�o','LEER',17);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Geo-Recursos e Geo-Ambiente','LGRGA',7);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Geoci�ncias e Geotecnologias ','LGG',11);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Geologia Isot�pica','LGI',18);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Geologia de Engenharia e Mec�nica dos Solos','LGEMS',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Hidroqu�mica Ambiental & Geoqu�mica Aplicada','LHAGA',18);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio do IT','LIT',11);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Is�topos Est�veis','LIE',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de L�minas Delgadas Polidas','LLDP',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Micro-An�lises & Microssonda','LMAM',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Monitoriza��o de Emiss�o Eletromagn�tica por Rochas Fraturadas','LMEERF',6);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Paleomagnetismo','LP',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Paleomagnetismo','LP',19);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Petrografia','LPET',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Prepara��o de Amostras','LPA',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Prospe��o El�ctrica e Electromagn�tica','LPEE',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Pulveriza��o de Amostras','LPA',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Radiometria','LR',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Raios-X','LRX',18);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Reflex�o S�smica','LRS',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Reflex�o S�smica Marinha e Batimetria','LRSMB',10);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Separa��o de Minerais','LSM',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Servi�os de Geologia Costeira','LSGC',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Sismologia','LS',5);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de Sistemas de Informa��o Geogr�fica','LSIG',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Laborat�rio de �guas Subterr�neas','LAS',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Litoteca','L',16);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Magnetic Observatory','MO',19);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('MicroSeismic Monitoring Laboratory','MML',12);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Natural Radioactivity Laboratory','NRL',19);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Observat�rio Astron�mico da Universidade do Porto','OAUP',6);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Rede S�smica Nacional','RSN',10);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Rede de Esta��es S�smicas','RES',20);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Seismic Station COI','SSCOI',19);
INSERT INTO laboratorio (lab_nome,lab_acronimo,inst_id) VALUES ('Space and Earth Geodetic Analysis Laboratory','SEGAL',17);
COMMIT;

BEGIN TRANSACTION
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('Centro de Ci�ncias do Mar e do Ambiente','CCMA','');
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('Centro de Estudos Geogr�ficos','CEG','');
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('Centro de Estudos Recursos Naturais, Ambiente e Sociedade','CERNAS','');
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('Centro de Geoci�ncias da Universidade de Coimbra','CGeo','');
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('Centro de Investiga��o da Terra e do Espa�o da Universidade de Coimbra','CITEUC','');
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('Centro de Pesquisa em Ci�ncias Geoespaciais','CICGE','');
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('Centro de Recursos Naturais e Ambiente','CERENA','');
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('GeoBioCi�ncias, GeoTecnologias e GeoEngenharia','GeoBioTec','');
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('Instituto de Ci�ncias da Terra','ICT','');
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('Instituto de Dom Luiz','IDL','');
INSERT INTO unidadeInvestigacao (unid_nome,unid_acro,unid_desc) VALUES ('Laborat�rio de Instrumenta��o e F�sica Experimental de Part�culas','LIP','');
COMMIT;

BEGIN TRANSACTION
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Seismological data and networks','WG1','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Geophysics exploration','WG2','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Rock physics and geomechanics laboratories','WG3','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Geodetic and gravimetric networks and data','WG4','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Geochemical and mineralogical laboratories','WG5','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Magnetic data and observations','WG6','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Geological data and laboratories','WG7','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Geomathematic infrastructures','WG8','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Remote sensing','WG9','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Laboratory of paleomagnetism','WG10','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Marine seismic reflection and bathymetry laboratory','WG11','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Georesources, extraction and processing','WG12','');
INSERT INTO grupoTrabalho (grp_nome,grp_acro,grp_desc) VALUES ('Monitoring permafrost environments','WG13','');
COMMIT;

BEGIN TRANSACTION
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (1,1);
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (2,2);
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (3,3);
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (4,4);
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (5,5);
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (6,6);
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (7,7);
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (8,8);
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (9,9);
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (10,10);
INSERT INTO unidade_grupo (grp_id,unid_id) VALUES (11,11);
COMMIT;

BEGIN TRANSACTION
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA2','Professional, technical and scientific training');
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA3','Interaction with stakeholders, including industry');
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA4','Communication and dissemination, including the promotion of public awareness and the dissemination of access rules and services');
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA6','Integrated services for fundamental science');
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA7','Integrated services for georesources');
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA8','Integrated services to mitigate natural risks');
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA9','Integrated services for geoenvironment');
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA10','Infrastructure structure and maintenance');
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA11','Marine Geology');
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA12','Integrated services for cosmic risk mitigation');
INSERT INTO linhasAcao (linhas_acro,linhas_nome) VALUES ('LA13','Integrated services for the mitigation of anthropogenic risks');
COMMIT;

/* Todas as passwords dos utilizadores s�o iniciadas como C4Gdefault e devem ser mudadas ap�s a configura��o da aplica��o */
BEGIN TRANSACTION
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Ant�nio Oliveira','aoliveira','aoliveira@c4g.eu',1,'Consultant',2,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Marcelo Soares','msoares','msoares@c4g.eu',1,'Team Member',1,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Rita Soares','rsoares','rsoares@c4g.eu',1,'Co-coordinator',2,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Ana Sousa','asousa','asousa@c4g.eu',1,'Observer',1,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Eduardo Amorim','eamorim','eamorim@c4g.eu',1,'Observer',1,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Alexandra Guedes','aguedes','aguedes@c4g.eu',1,'Co-coordinator',2,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Rui Fernandes','rfernandes','rfernandes@c4g.eu',1,'Co-coordinator',2,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Rui Almeida','ralmeida','ralmeida@email.com',0,'Team Member',1,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Ramiro Guedes','rguedes','rguedes@c4g.eu',1,'Co-coordinator',2,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Nuno Dias','ndias','ndias@c4g.eu',1,'Team Member',1,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Fernando Borges','fborges','fborges@c4g.eu',1,'Consultant',2,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Fernando Carrilho','fcarrilho','fcarrilho@c44g.eu',1,'Team Member',1,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Lu�s Carrilho','lcarrilho','lcarrilho@c4g.eu',1,'Consultant',2,'C4Gdefault');
INSERT INTO utilizador (nome,u_nome,u_email,u_membro,u_funcao,u_tipo,u_password) VALUES ('Gustavo Guedes','gguedes','gguedes@email.com',0,'Team Member',1,'C4Gdefault');
COMMIT;

BEGIN TRANSACTION
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Sismogramas da rede s�smica portuguesa permanente','D',2);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Metadados da rede s�smica permanente','D',6);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Mapas s�smicos','P',8);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Listagens da atividade s�smica (atualiza��o em tempo quase real)','P',11);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Boletins s�smicos mensais','P',3);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Cat�logos s�smicos','P',14);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Shakemaps','P',8);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Mecanismos focai','P',12);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Monitoriza��o e vigil�ncia s�smica dos A�ores, Madeira e Continente (Alertas r�pidos para o sistema de prote��o civil e para a popula��o)','S',11);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Campanhas de monitoriza��o espec�ficas com redes s�smicas m�veis','S',2);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Acesso a arquivos de sismogramas (raw data + metadata)','S',5);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Est�gios de curta-m�dia dura��o (para profissionais): opera��o e gest�o de rede s�smicas','F',3);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Est�gios de curta-m�dia dura��o (para profissionais): processamento e an�lise s�smica','F',4);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Est�gios de curta dura��o (para alunos dos ensinos secund�rio e superior): redes s�smicas','F',7);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Dados de perfis de s�smica de reflex�o e refra��o superficial','D',8);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Dados de perfis geoel�tricos e electromagn�ticos','D',10);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Dados de perfis de resistividade/IP e de tomografia s�smica','D',5);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Formas de onda da esta��o s�smica EVO em registo cont�nuo desde 2006 ','D',6);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Formas de onda de redes s�smicas tempor�rias: �vora (1997-1998); Algarve (desde 2006); Arraiolos (desde 2017)','D',3);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Ruido s�smico (Portugal: Vale do Tejo, Ilhas do Faial, Pico e S. Jorge; Arg�lia: Bacia de Mitid-ja)','D',5);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('S�smica de refra��o no Faial','D',7);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Perfis de Tomografia el�trica no Vale do Tejo','D',7);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Perfis de Georadar (Vale do Tejo)','D',8);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Dados de estudos aplicados em Arqueologia (desde 2010): GPR, eletromagn�tica, Tomografia el�trica e Magnetometria (Portugal, Espanha e Marrocos)','D',4);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Relat�rios t�cnicos de sondagens geot�cnicas, geof�sica, geot�rmicas','P',3);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Mapas � escala 1: 1 M de radiometria','P',10);
INSERT INTO servico (servico_nome,servico_tipo,servico_coord) VALUES ('Mapas � escala 400 K de gravimetria (anomalia Bouguer) e anomalia magn�tica','P',5);
COMMIT;

BEGIN TRANSACTION
INSERT INTO associado (servico_id,grp_id) VALUES (1,1);
INSERT INTO associado (servico_id,grp_id) VALUES (2,1);
INSERT INTO associado (servico_id,grp_id) VALUES (3,1);
INSERT INTO associado (servico_id,grp_id) VALUES (4,1);
INSERT INTO associado (servico_id,grp_id) VALUES (5,1);
INSERT INTO associado (servico_id,grp_id) VALUES (6,1);
INSERT INTO associado (servico_id,grp_id) VALUES (7,1);
INSERT INTO associado (servico_id,grp_id) VALUES (8,1);
INSERT INTO associado (servico_id,grp_id) VALUES (9,1);
INSERT INTO associado (servico_id,grp_id) VALUES (10,1);
INSERT INTO associado (servico_id,grp_id) VALUES (11,1);
INSERT INTO associado (servico_id,grp_id) VALUES (12,1);
INSERT INTO associado (servico_id,grp_id) VALUES (13,1);
INSERT INTO associado (servico_id,grp_id) VALUES (14,1);
INSERT INTO associado (servico_id,grp_id) VALUES (15,2);
INSERT INTO associado (servico_id,grp_id) VALUES (16,2);
INSERT INTO associado (servico_id,grp_id) VALUES (17,2);
INSERT INTO associado (servico_id,grp_id) VALUES (18,2);
INSERT INTO associado (servico_id,grp_id) VALUES (19,2);
INSERT INTO associado (servico_id,grp_id) VALUES (20,2);
INSERT INTO associado (servico_id,grp_id) VALUES (21,2);
INSERT INTO associado (servico_id,grp_id) VALUES (22,2);
INSERT INTO associado (servico_id,grp_id) VALUES (23,2);
INSERT INTO associado (servico_id,grp_id) VALUES (24,2);
INSERT INTO associado (servico_id,grp_id) VALUES (25,2);
INSERT INTO associado (servico_id,grp_id) VALUES (26,2);
INSERT INTO associado (servico_id,grp_id) VALUES (27,2);
COMMIT;

/* Dados */
BEGIN TRANSACTION
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Sismogramas da rede s�smica portuguesa permanente','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Metadados da rede s�smica permanente','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Dados de perfis de s�smica de reflex�o e refra��o superficial','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Dados de perfis de resistividade/IP e de tomografia s�smica','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Dados de perfis geoel�tricos e electromagn�ticos','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Formas de onda da esta��o s�smica EVO em registo cont�nuo desde 2006','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Formas de onda de redes s�smicas tempor�rias: �vora (1997-1998); Algarve (desde 2006); Arraiolos (desde 2017)','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Ruido s�smico (Portugal: Vale do Tejo, Ilhas do Faial, Pico e S. Jorge; Arg�lia: Bacia de Mitid-ja)','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('S�smica de refra��o no Faial','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Perfis de Tomografia el�trica no Vale do Tejo','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Perfis de Georadar (Vale do Tejo)','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Dados de estudos aplicados em Arqueologia (desde 2010): GPR, eletromagn�tica, Tomografia el�trica e Magnetometria (Portugal, Espanha e Marrocos)','','',0);

/* Produtos */

/* 13 */INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Mapas s�smicos','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Listagens da atividade s�smica (atualiza��o em tempo quase real)','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Boletins s�smicos mensais','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Cat�logos s�smicos','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Shakemaps','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Mecanismos focai','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Relat�rios t�cnicos de sondagens geot�cnicas, geof�sica, geot�rmicas','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Mapas � escala 1: 1 M de radiometria','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Mapas � escala 400 K de gravimetria (anomalia Bouguer) e anomalia magn�tica','','',0);

/*Forma��o*/

/* 22 */INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Est�gios de curta-m�dia dura��o (para profissionais): opera��o e gest�o de rede s�smicas','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Est�gios de curta-m�dia dura��o (para profissionais): processamento e an�lise s�smica','','',0);
INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES ('Est�gios de curta dura��o (para alunos dos ensinos secund�rio e superior): redes s�smicas','','',0);

INSERT INTO responsavel (rec_id,u_id) VALUES (1,4);
INSERT INTO responsavel (rec_id,u_id) VALUES (2,2);
INSERT INTO responsavel (rec_id,u_id) VALUES (3,6);
INSERT INTO responsavel (rec_id,u_id) VALUES (4,5);
INSERT INTO responsavel (rec_id,u_id) VALUES (5,4);
INSERT INTO responsavel (rec_id,u_id) VALUES (6,13);
INSERT INTO responsavel (rec_id,u_id) VALUES (7,9);
INSERT INTO responsavel (rec_id,u_id) VALUES (8,3);
INSERT INTO responsavel (rec_id,u_id) VALUES (9,12);
INSERT INTO responsavel (rec_id,u_id) VALUES (10,11);
INSERT INTO responsavel (rec_id,u_id) VALUES (11,10);
INSERT INTO responsavel (rec_id,u_id) VALUES (12,8);
INSERT INTO responsavel (rec_id,u_id) VALUES (13,6);
INSERT INTO responsavel (rec_id,u_id) VALUES (14,2);
INSERT INTO responsavel (rec_id,u_id) VALUES (15,4);
INSERT INTO responsavel (rec_id,u_id) VALUES (16,6);
INSERT INTO responsavel (rec_id,u_id) VALUES (17,3);
INSERT INTO responsavel (rec_id,u_id) VALUES (18,14);
INSERT INTO responsavel (rec_id,u_id) VALUES (19,11);
INSERT INTO responsavel (rec_id,u_id) VALUES (20,12);
INSERT INTO responsavel (rec_id,u_id) VALUES (21,4);
INSERT INTO responsavel (rec_id,u_id) VALUES (22,8);
INSERT INTO responsavel (rec_id,u_id) VALUES (23,5);
INSERT INTO responsavel (rec_id,u_id) VALUES (24,3);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (1,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (1,33);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (1,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (1,38);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (2,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (2,33);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (2,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (2,38);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (13,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (13,33);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (13,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (13,38);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (14,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (14,33);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (14,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (14,38);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (15,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (15,33);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (15,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (15,38);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (16,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (16,33);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (16,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (16,38);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (17,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (17,33);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (17,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (17,38);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (18,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (18,33);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (18,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (18,38);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (22,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (22,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (22,33);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (23,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (23,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (23,33);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (24,41);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (24,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (24,33);

INSERT INTO disponibilizam (rec_id,lab_id) VALUES (3,34);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (4,34);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (5,12);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (6,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (7,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (8,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (9,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (10,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (11,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (12,42);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (19,24);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (20,24);
INSERT INTO disponibilizam (rec_id,lab_id) VALUES (21,24);
COMMIT;

BEGIN TRANSACTION
INSERT INTO incui (servico_id,rec_id) VALUES (1,1);
INSERT INTO incui (servico_id,rec_id) VALUES (2,2);
INSERT INTO incui (servico_id,rec_id) VALUES (3,13);
INSERT INTO incui (servico_id,rec_id) VALUES (4,14);
INSERT INTO incui (servico_id,rec_id) VALUES (5,15);
INSERT INTO incui (servico_id,rec_id) VALUES (6,16);
INSERT INTO incui (servico_id,rec_id) VALUES (7,17);
INSERT INTO incui (servico_id,rec_id) VALUES (8,18);
INSERT INTO incui (servico_id,rec_id) VALUES (12,22);
INSERT INTO incui (servico_id,rec_id) VALUES (13,23);
INSERT INTO incui (servico_id,rec_id) VALUES (14,24);
INSERT INTO incui (servico_id,rec_id) VALUES (15,3);
INSERT INTO incui (servico_id,rec_id) VALUES (16,4);
INSERT INTO incui (servico_id,rec_id) VALUES (17,5);
INSERT INTO incui (servico_id,rec_id) VALUES (18,6);
INSERT INTO incui (servico_id,rec_id) VALUES (19,7);
INSERT INTO incui (servico_id,rec_id) VALUES (20,8);
INSERT INTO incui (servico_id,rec_id) VALUES (21,9);
INSERT INTO incui (servico_id,rec_id) VALUES (22,10);
INSERT INTO incui (servico_id,rec_id) VALUES (23,11);
INSERT INTO incui (servico_id,rec_id) VALUES (24,12);
INSERT INTO incui (servico_id,rec_id) VALUES (25,19);
INSERT INTO incui (servico_id,rec_id) VALUES (26,20);
INSERT INTO incui (servico_id,rec_id) VALUES (27,21);
COMMIT;

BEGIN TRANSACTION
INSERT INTO produtos (rec_id,prod_tipo,prod_nivel,prod_web) VALUES (13,'m',2,'');
INSERT INTO produtos (rec_id,prod_tipo,prod_nivel,prod_web) VALUES (14,'',2,'');
INSERT INTO produtos (rec_id,prod_tipo,prod_nivel,prod_web) VALUES (15,'bol',2,'');
INSERT INTO produtos (rec_id,prod_tipo,prod_nivel,prod_web) VALUES (16,'cat',2,'');
INSERT INTO produtos (rec_id,prod_tipo,prod_nivel,prod_web) VALUES (17,'m',2,'');
INSERT INTO produtos (rec_id,prod_tipo,prod_nivel,prod_web) VALUES (18,'m',2,'');
INSERT INTO produtos (rec_id,prod_tipo,prod_nivel,prod_web) VALUES (19,'rel',2,'');
INSERT INTO produtos (rec_id,prod_tipo,prod_nivel,prod_web) VALUES (20,'m',2,'');
INSERT INTO produtos (rec_id,prod_tipo,prod_nivel,prod_web) VALUES (21,'m',2,'');
COMMIT;

BEGIN TRANSACTION
INSERT INTO dados (rec_id,dados_web) VALUES (1,'');
INSERT INTO dados (rec_id,dados_web) VALUES (2,'');
INSERT INTO dados (rec_id,dados_web) VALUES (3,'');
INSERT INTO dados (rec_id,dados_web) VALUES (4,'');
INSERT INTO dados (rec_id,dados_web) VALUES (5,'');
INSERT INTO dados (rec_id,dados_web) VALUES (6,'');
INSERT INTO dados (rec_id,dados_web) VALUES (7,'');
INSERT INTO dados (rec_id,dados_web) VALUES (8,'');
INSERT INTO dados (rec_id,dados_web) VALUES (9,'');
INSERT INTO dados (rec_id,dados_web) VALUES (10,'');
INSERT INTO dados (rec_id,dados_web) VALUES (11,'');
INSERT INTO dados (rec_id,dados_web) VALUES (12,'');
COMMIT;

BEGIN TRANSACTION
INSERT INTO formacao (rec_id,form_tipo,form_vagas) VALUES (22,'presencial',100);
INSERT INTO formacao (rec_id,form_tipo,form_vagas) VALUES (23,'presencial',100);
INSERT INTO formacao (rec_id,form_tipo,form_vagas) VALUES (24,'presencial',100);
COMMIT;

BEGIN TRANSACTION
INSERT INTO pertence_grupo (u_id,grp_id) VALUES (2,10);/* Pertence � unidade 10 */
INSERT INTO pertence (u_id,lab_id) VALUES (2,4);/* Pertence ao LAB4 */
COMMIT;

BEGIN TRANSACTION
INSERT INTO pertence_grupo (u_id,grp_id) VALUES (3,10);/* Pertence � unidade 10 */
INSERT INTO pertence (u_id,lab_id) VALUES (3,5);/* Pertence ao LAB5 */
COMMIT;

BEGIN TRANSACTION
INSERT INTO pertence_grupo (u_id,grp_id) VALUES (4,10);/* Pertence � unidade 10 */
INSERT INTO pertence (u_id,lab_id) VALUES (4,18);/* Pertence ao LAB18 */
COMMIT;

BEGIN TRANSACTION
INSERT INTO pertence_grupo (u_id,grp_id) VALUES (5,10);/* Pertence � unidade 10 */
INSERT INTO pertence (u_id,lab_id) VALUES (5,19);/* Pertence ao LAB19 */
COMMIT;

BEGIN TRANSACTION
INSERT INTO pertence_grupo (u_id,grp_id) VALUES (6,10);/* Pertence � unidade 10 */
INSERT INTO pertence (u_id,lab_id) VALUES (6,21);/* Pertence ao LAB21 */
COMMIT;

BEGIN TRANSACTION
INSERT INTO pertence_grupo (u_id,grp_id) VALUES (7,10);/* Pertence � unidade 10 */
INSERT INTO pertence (u_id,lab_id) VALUES (7,31);/* Pertence ao LAB31 */
COMMIT;

BEGIN TRANSACTION
INSERT INTO pertence_grupo (u_id,grp_id) VALUES (8,10);/* Pertence � unidade 10 */
INSERT INTO pertence (u_id,lab_id) VALUES (8,42);/* Pertence ao LAB42 */
COMMIT;

BEGIN TRANSACTION
INSERT INTO pertence_grupo (u_id,grp_id) VALUES (9,10);/* Pertence � unidade 10 */
INSERT INTO pertence (u_id,lab_id) VALUES (9,44);/* Pertence ao LAB44 */
COMMIT;

BEGIN TRANSACTION
INSERT INTO pertence_grupo (u_id,grp_id) VALUES (10,5); /* Pertence � unidade 5 */
INSERT INTO pertence (u_id,lab_id) VALUES (10,22);  /* Pertence ao LAB22 */
COMMIT;

