-- Table: sismenu

-- DROP TABLE sismenu;

CREATE TABLE sismenu
(
  sismenu_id serial NOT NULL,
  sismenu_descripcion character varying(150) NOT NULL,
  sismenu_estado integer NOT NULL DEFAULT 0,
  sismenu_parent integer NOT NULL,
  CONSTRAINT pksismenu PRIMARY KEY (sismenu_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sismenu OWNER TO postgres;



-- Table: sisperfil

-- DROP TABLE sisperfil;

CREATE TABLE sisperfil
(
  sisperfil_id serial NOT NULL,
  sismenu_id integer NOT NULL,
  perfiles_id integer NOT NULL,
  sisperfil_estado integer NOT NULL DEFAULT 0,
  sisperfil_fecha_creacion timestamp without time zone DEFAULT now(),
  CONSTRAINT pksisperfil PRIMARY KEY (sisperfil_id),
  CONSTRAINT perfiles_id FOREIGN KEY (perfiles_id)
      REFERENCES perfiles (perfiles_id) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT sismenu_id FOREIGN KEY (sismenu_id)
      REFERENCES sismenu (sismenu_id) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sisperfil OWNER TO postgres;


-- Table: sisvinculos

-- DROP TABLE sisvinculos;

CREATE TABLE sisvinculos
(
  sisvinculos_id serial NOT NULL,
  sismenu_id integer NOT NULL,
  sisvinculos_link character varying(250) NOT NULL,
  sisvinculos_fecha_creacion timestamp without time zone DEFAULT now(),
  CONSTRAINT pksisvinculos PRIMARY KEY (sisvinculos_id),
  CONSTRAINT sismenu_id FOREIGN KEY (sismenu_id)
      REFERENCES sismenu (sismenu_id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sisvinculos OWNER TO postgres;


-- Table: usuarios

-- DROP TABLE usuarios;

CREATE TABLE usuarios
(
  usuarios_id serial NOT NULL,
  usuarios_username character varying(150) NOT NULL,
  usuarios_password character varying(150) NOT NULL,
  usuarios_nombre character varying(150) NOT NULL,
  usuarios_apellido character varying(150) NOT NULL,
  usuarios_email character varying(150) NOT NULL,
  usuarios_estado integer NOT NULL DEFAULT 0,
  perfiles_id integer NOT NULL,
  usuarios_fecha_creacion timestamp without time zone DEFAULT now(),
  CONSTRAINT pkusuarios PRIMARY KEY (usuarios_id),
  CONSTRAINT perfiles_id FOREIGN KEY (perfiles_id)
      REFERENCES perfiles (perfiles_id) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);
ALTER TABLE usuarios OWNER TO postgres;


-- Table: perfiles

-- DROP TABLE perfiles;

CREATE TABLE perfiles
(
  perfiles_id serial NOT NULL,
  perfiles_descripcion character varying(150) NOT NULL,
  perfiles_estado integer NOT NULL DEFAULT 0,
  perfiles_fecha_creacion timestamp without time zone DEFAULT now(),
  CONSTRAINT pkperfiles PRIMARY KEY (perfiles_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE perfiles OWNER TO postgres;


-- Table: sispermisos

-- DROP TABLE sispermisos;

CREATE TABLE sispermisos
(
  sispermisos_id serial NOT NULL,
  sispermisos_tabla character varying(150) NOT NULL,
  sispermisos_flag_read integer NOT NULL DEFAULT 1,
  sispermisos_flag_insert integer NOT NULL DEFAULT 0,
  sispermisos_flag_update integer NOT NULL DEFAULT 0,
  sispermisos_flag_delete integer NOT NULL DEFAULT 0,
  perfiles_id integer NOT NULL,
  sispermisos_fecha_creacion timestamp without time zone NOT NULL DEFAULT now(),
  CONSTRAINT pksispermisos PRIMARY KEY (sispermisos_id),
  CONSTRAINT perfiles_id FOREIGN KEY (perfiles_id)
      REFERENCES perfiles (perfiles_id) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
)
WITH (
  OIDS=FALSE
);
ALTER TABLE sispermisos OWNER TO postgres;


