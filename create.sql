

CREATE TABLE "Authors" (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);

CREATE SEQUENCE "Authors_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE "Authors_id_seq" OWNED BY "Authors".id;


CREATE TABLE "Languages" (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);

CREATE SEQUENCE "Languages_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE "Languages_id_seq" OWNED BY "Languages".id;


CREATE TABLE "Posts" (
    id integer NOT NULL,
    "languageId" integer NOT NULL,
    "authorId" integer NOT NULL,
    "dateCreated" integer NOT NULL,
    title character varying(512) NOT NULL,
    text text NOT NULL,
    "likesCount" integer DEFAULT 0 NOT NULL
);

CREATE SEQUENCE "Posts_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE "Posts_id_seq" OWNED BY "Posts".id;


ALTER TABLE ONLY "Authors" ALTER COLUMN id SET DEFAULT nextval('"Authors_id_seq"'::regclass);

ALTER TABLE ONLY "Languages" ALTER COLUMN id SET DEFAULT nextval('"Languages_id_seq"'::regclass);

ALTER TABLE ONLY "Posts" ALTER COLUMN id SET DEFAULT nextval('"Posts_id_seq"'::regclass);


ALTER TABLE ONLY "Authors"
    ADD CONSTRAINT "Authors_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Languages"
    ADD CONSTRAINT "Languages_pkey" PRIMARY KEY (id);

ALTER TABLE ONLY "Posts"
    ADD CONSTRAINT "Posts_pkey" PRIMARY KEY (id);


CREATE INDEX "DateCreatedPosts" ON "Posts" USING btree ("dateCreated");

CREATE INDEX "LikesCountPosts" ON "Posts" USING btree ("likesCount");

CREATE UNIQUE INDEX "NameAuthors" ON "Authors" USING btree (name);

CREATE UNIQUE INDEX "NameLanguages" ON "Languages" USING btree (name);

CREATE INDEX "TitlePosts" ON "Posts" USING btree (title);


ALTER TABLE ONLY "Posts"
    ADD CONSTRAINT "AuthorId" FOREIGN KEY ("authorId") REFERENCES "Authors"(id) ON DELETE CASCADE;

ALTER TABLE ONLY "Posts"
    ADD CONSTRAINT "LanguageId" FOREIGN KEY ("languageId") REFERENCES "Languages"(id) ON DELETE CASCADE;


INSERT INTO "Authors" (name) VALUES ('CrazyNews'), ('Чук и Гек'), ('CatFuns'), ('CarDriver'), ('BestPics'), ('ЗОЖ'), ('Вася Пупкин'), ('Готовим со вкусом'), ('Шахтёрская Правда'), ('FunScience');

INSERT INTO "Languages" (name) VALUES ('Русский'), ('English');
