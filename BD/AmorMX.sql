PGDMP     ;    -            
    {            AmorMX    15.4    15.4 K    R           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            S           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            T           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            U           1262    16676    AmorMX    DATABASE     ~   CREATE DATABASE "AmorMX" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Colombia.1252';
    DROP DATABASE "AmorMX";
                postgres    false            �            1259    16677    Sesiones    TABLE     �   CREATE TABLE public."Sesiones" (
    id integer NOT NULL,
    fecha date,
    hora time with time zone,
    id_usuario integer
);
    DROP TABLE public."Sesiones";
       public         heap    postgres    false            �            1259    16680    Sesiones_id_seq    SEQUENCE     �   CREATE SEQUENCE public."Sesiones_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public."Sesiones_id_seq";
       public          postgres    false    214            V           0    0    Sesiones_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public."Sesiones_id_seq" OWNED BY public."Sesiones".id;
          public          postgres    false    215            �            1259    16681    usuarios    TABLE     &  CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nombre_completo character varying,
    cedula character varying,
    contrasena character varying,
    correo character varying,
    telefono character varying,
    id_tipo_usuario integer NOT NULL,
    direccion character varying
);
    DROP TABLE public.usuarios;
       public         heap    postgres    false            �            1259    16686    Usuarios _id_seq    SEQUENCE     �   CREATE SEQUENCE public."Usuarios _id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public."Usuarios _id_seq";
       public          postgres    false    216            W           0    0    Usuarios _id_seq    SEQUENCE OWNED BY     F   ALTER SEQUENCE public."Usuarios _id_seq" OWNED BY public.usuarios.id;
          public          postgres    false    217            �            1259    16687 
   categorias    TABLE     �   CREATE TABLE public.categorias (
    id integer NOT NULL,
    nombre_categoria character varying,
    estado character varying,
    ruta text
);
    DROP TABLE public.categorias;
       public         heap    postgres    false            �            1259    16692    categorias_id_seq    SEQUENCE     �   CREATE SEQUENCE public.categorias_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.categorias_id_seq;
       public          postgres    false    218            X           0    0    categorias_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.categorias_id_seq OWNED BY public.categorias.id;
          public          postgres    false    219            �            1259    16693    factura    TABLE     �   CREATE TABLE public.factura (
    id integer NOT NULL,
    numero integer,
    id_pedido_mesa integer,
    total integer,
    fecha date,
    hora time with time zone
);
    DROP TABLE public.factura;
       public         heap    postgres    false            �            1259    16696    factura_id_seq    SEQUENCE     �   CREATE SEQUENCE public.factura_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.factura_id_seq;
       public          postgres    false    220            Y           0    0    factura_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.factura_id_seq OWNED BY public.factura.id;
          public          postgres    false    221            �            1259    16697    mesas    TABLE     �   CREATE TABLE public.mesas (
    id integer NOT NULL,
    nombre_tipo character varying,
    numero_mesa character varying,
    estado character varying
);
    DROP TABLE public.mesas;
       public         heap    postgres    false            �            1259    16702    mesas_id_seq    SEQUENCE     �   CREATE SEQUENCE public.mesas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.mesas_id_seq;
       public          postgres    false    222            Z           0    0    mesas_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.mesas_id_seq OWNED BY public.mesas.id;
          public          postgres    false    223            �            1259    16703    pedidos    TABLE     �   CREATE TABLE public.pedidos (
    id integer NOT NULL,
    id_mesa integer NOT NULL,
    id_usuario integer,
    fecha date,
    hora time with time zone
);
    DROP TABLE public.pedidos;
       public         heap    postgres    false            �            1259    16706    pedidos_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pedidos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.pedidos_id_seq;
       public          postgres    false    224            [           0    0    pedidos_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.pedidos_id_seq OWNED BY public.pedidos.id;
          public          postgres    false    225            �            1259    16707    pedidos_mesa    TABLE     �   CREATE TABLE public.pedidos_mesa (
    id integer NOT NULL,
    id_pedido integer,
    id_plato integer NOT NULL,
    cantidad integer
);
     DROP TABLE public.pedidos_mesa;
       public         heap    postgres    false            �            1259    16710    pedidos_mesa_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pedidos_mesa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.pedidos_mesa_id_seq;
       public          postgres    false    226            \           0    0    pedidos_mesa_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.pedidos_mesa_id_seq OWNED BY public.pedidos_mesa.id;
          public          postgres    false    227            �            1259    16711    platos    TABLE     �   CREATE TABLE public.platos (
    id integer NOT NULL,
    id_categoria integer,
    nombre character varying,
    precio integer,
    ruta character varying
);
    DROP TABLE public.platos;
       public         heap    postgres    false            �            1259    16716    platos_id_seq    SEQUENCE     �   CREATE SEQUENCE public.platos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.platos_id_seq;
       public          postgres    false    228            ]           0    0    platos_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.platos_id_seq OWNED BY public.platos.id;
          public          postgres    false    229            �            1259    16717    tipo_usuario    TABLE        CREATE TABLE public.tipo_usuario (
    id integer NOT NULL,
    nombre_tipo character varying,
    estado character varying
);
     DROP TABLE public.tipo_usuario;
       public         heap    postgres    false            �            1259    16722    tipo_usuario_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.tipo_usuario_id_seq;
       public          postgres    false    230            ^           0    0    tipo_usuario_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.tipo_usuario_id_seq OWNED BY public.tipo_usuario.id;
          public          postgres    false    231            �           2604    16723    Sesiones id    DEFAULT     n   ALTER TABLE ONLY public."Sesiones" ALTER COLUMN id SET DEFAULT nextval('public."Sesiones_id_seq"'::regclass);
 <   ALTER TABLE public."Sesiones" ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    214            �           2604    16725    categorias id    DEFAULT     n   ALTER TABLE ONLY public.categorias ALTER COLUMN id SET DEFAULT nextval('public.categorias_id_seq'::regclass);
 <   ALTER TABLE public.categorias ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    218            �           2604    16726 
   factura id    DEFAULT     h   ALTER TABLE ONLY public.factura ALTER COLUMN id SET DEFAULT nextval('public.factura_id_seq'::regclass);
 9   ALTER TABLE public.factura ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    220            �           2604    16727    mesas id    DEFAULT     d   ALTER TABLE ONLY public.mesas ALTER COLUMN id SET DEFAULT nextval('public.mesas_id_seq'::regclass);
 7   ALTER TABLE public.mesas ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222            �           2604    16728 
   pedidos id    DEFAULT     h   ALTER TABLE ONLY public.pedidos ALTER COLUMN id SET DEFAULT nextval('public.pedidos_id_seq'::regclass);
 9   ALTER TABLE public.pedidos ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    224            �           2604    16729    pedidos_mesa id    DEFAULT     r   ALTER TABLE ONLY public.pedidos_mesa ALTER COLUMN id SET DEFAULT nextval('public.pedidos_mesa_id_seq'::regclass);
 >   ALTER TABLE public.pedidos_mesa ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    226            �           2604    16730 	   platos id    DEFAULT     f   ALTER TABLE ONLY public.platos ALTER COLUMN id SET DEFAULT nextval('public.platos_id_seq'::regclass);
 8   ALTER TABLE public.platos ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    229    228            �           2604    16731    tipo_usuario id    DEFAULT     r   ALTER TABLE ONLY public.tipo_usuario ALTER COLUMN id SET DEFAULT nextval('public.tipo_usuario_id_seq'::regclass);
 >   ALTER TABLE public.tipo_usuario ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    231    230            �           2604    16724    usuarios id    DEFAULT     m   ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public."Usuarios _id_seq"'::regclass);
 :   ALTER TABLE public.usuarios ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    216            >          0    16677    Sesiones 
   TABLE DATA           A   COPY public."Sesiones" (id, fecha, hora, id_usuario) FROM stdin;
    public          postgres    false    214   OR       B          0    16687 
   categorias 
   TABLE DATA           H   COPY public.categorias (id, nombre_categoria, estado, ruta) FROM stdin;
    public          postgres    false    218   lR       D          0    16693    factura 
   TABLE DATA           Q   COPY public.factura (id, numero, id_pedido_mesa, total, fecha, hora) FROM stdin;
    public          postgres    false    220   FS       F          0    16697    mesas 
   TABLE DATA           E   COPY public.mesas (id, nombre_tipo, numero_mesa, estado) FROM stdin;
    public          postgres    false    222   cS       H          0    16703    pedidos 
   TABLE DATA           G   COPY public.pedidos (id, id_mesa, id_usuario, fecha, hora) FROM stdin;
    public          postgres    false    224   �S       J          0    16707    pedidos_mesa 
   TABLE DATA           I   COPY public.pedidos_mesa (id, id_pedido, id_plato, cantidad) FROM stdin;
    public          postgres    false    226   �S       L          0    16711    platos 
   TABLE DATA           H   COPY public.platos (id, id_categoria, nombre, precio, ruta) FROM stdin;
    public          postgres    false    228   �S       N          0    16717    tipo_usuario 
   TABLE DATA           ?   COPY public.tipo_usuario (id, nombre_tipo, estado) FROM stdin;
    public          postgres    false    230   �S       @          0    16681    usuarios 
   TABLE DATA           y   COPY public.usuarios (id, nombre_completo, cedula, contrasena, correo, telefono, id_tipo_usuario, direccion) FROM stdin;
    public          postgres    false    216   0T       _           0    0    Sesiones_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public."Sesiones_id_seq"', 1, false);
          public          postgres    false    215            `           0    0    Usuarios _id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public."Usuarios _id_seq"', 11, true);
          public          postgres    false    217            a           0    0    categorias_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.categorias_id_seq', 16, true);
          public          postgres    false    219            b           0    0    factura_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.factura_id_seq', 1, false);
          public          postgres    false    221            c           0    0    mesas_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.mesas_id_seq', 1, false);
          public          postgres    false    223            d           0    0    pedidos_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.pedidos_id_seq', 1, false);
          public          postgres    false    225            e           0    0    pedidos_mesa_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.pedidos_mesa_id_seq', 1, false);
          public          postgres    false    227            f           0    0    platos_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.platos_id_seq', 1, true);
          public          postgres    false    229            g           0    0    tipo_usuario_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.tipo_usuario_id_seq', 4, true);
          public          postgres    false    231            �           2606    16733    Sesiones Sesiones_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public."Sesiones"
    ADD CONSTRAINT "Sesiones_pkey" PRIMARY KEY (id);
 D   ALTER TABLE ONLY public."Sesiones" DROP CONSTRAINT "Sesiones_pkey";
       public            postgres    false    214            �           2606    16735    usuarios Usuarios _pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT "Usuarios _pkey" PRIMARY KEY (id);
 C   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT "Usuarios _pkey";
       public            postgres    false    216            �           2606    16737    categorias categorias_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.categorias DROP CONSTRAINT categorias_pkey;
       public            postgres    false    218            �           2606    16739    factura factura_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.factura
    ADD CONSTRAINT factura_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.factura DROP CONSTRAINT factura_pkey;
       public            postgres    false    220            �           2606    16741    mesas mesas_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.mesas
    ADD CONSTRAINT mesas_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.mesas DROP CONSTRAINT mesas_pkey;
       public            postgres    false    222            �           2606    16743    pedidos_mesa pedidos_mesa_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.pedidos_mesa
    ADD CONSTRAINT pedidos_mesa_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.pedidos_mesa DROP CONSTRAINT pedidos_mesa_pkey;
       public            postgres    false    226            �           2606    16745    pedidos pedidos_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT pedidos_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.pedidos DROP CONSTRAINT pedidos_pkey;
       public            postgres    false    224            �           2606    16747    platos platos_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.platos
    ADD CONSTRAINT platos_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.platos DROP CONSTRAINT platos_pkey;
       public            postgres    false    228            �           2606    16749    tipo_usuario tipo_usuario_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.tipo_usuario
    ADD CONSTRAINT tipo_usuario_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.tipo_usuario DROP CONSTRAINT tipo_usuario_pkey;
       public            postgres    false    230            �           2606    16750    pedidos id_mesa    FK CONSTRAINT     x   ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT id_mesa FOREIGN KEY (id_mesa) REFERENCES public.mesas(id) NOT VALID;
 9   ALTER TABLE ONLY public.pedidos DROP CONSTRAINT id_mesa;
       public          postgres    false    222    224    3231            �           2606    16755    pedidos_mesa id_pedido    FK CONSTRAINT     �   ALTER TABLE ONLY public.pedidos_mesa
    ADD CONSTRAINT id_pedido FOREIGN KEY (id_pedido) REFERENCES public.pedidos(id) NOT VALID;
 @   ALTER TABLE ONLY public.pedidos_mesa DROP CONSTRAINT id_pedido;
       public          postgres    false    226    224    3233            �           2606    16760    factura id_pedido_mesa    FK CONSTRAINT     �   ALTER TABLE ONLY public.factura
    ADD CONSTRAINT id_pedido_mesa FOREIGN KEY (id_pedido_mesa) REFERENCES public.pedidos_mesa(id);
 @   ALTER TABLE ONLY public.factura DROP CONSTRAINT id_pedido_mesa;
       public          postgres    false    220    226    3235            �           2606    16765    pedidos_mesa id_plato    FK CONSTRAINT     �   ALTER TABLE ONLY public.pedidos_mesa
    ADD CONSTRAINT id_plato FOREIGN KEY (id_plato) REFERENCES public.platos(id) NOT VALID;
 ?   ALTER TABLE ONLY public.pedidos_mesa DROP CONSTRAINT id_plato;
       public          postgres    false    228    3237    226            �           2606    16770    usuarios id_tipo_usuario    FK CONSTRAINT     �   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT id_tipo_usuario FOREIGN KEY (id_tipo_usuario) REFERENCES public.tipo_usuario(id) NOT VALID;
 B   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT id_tipo_usuario;
       public          postgres    false    230    216    3239            �           2606    16775    Sesiones id_usuario    FK CONSTRAINT     z   ALTER TABLE ONLY public."Sesiones"
    ADD CONSTRAINT id_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id);
 ?   ALTER TABLE ONLY public."Sesiones" DROP CONSTRAINT id_usuario;
       public          postgres    false    216    3225    214            �           2606    16780    pedidos id_usuario    FK CONSTRAINT     �   ALTER TABLE ONLY public.pedidos
    ADD CONSTRAINT id_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuarios(id) NOT VALID;
 <   ALTER TABLE ONLY public.pedidos DROP CONSTRAINT id_usuario;
       public          postgres    false    224    3225    216            �           2606    16785    platos platos_id_categoria_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.platos
    ADD CONSTRAINT platos_id_categoria_fkey FOREIGN KEY (id_categoria) REFERENCES public.categorias(id);
 I   ALTER TABLE ONLY public.platos DROP CONSTRAINT platos_id_categoria_fkey;
       public          postgres    false    228    3227    218            >      x������ � �      B   �   x�����0�g�)2�@H��7B&;�!���r��OO@ B�r��-�
�x=x�m��߄b��J`削�5����
�,�rk[�q��¶�:��BϘ�`��4S�壥��Q�t�u��l-��%!C�l�(8�o1B���B�?q��6G�ť���������;�@�u�	���ƪ����NFJ�dʵ��\��>V���_�m      D      x������ � �      F      x������ � �      H      x������ � �      J      x������ � �      L      x�3�4��ͬ(I�4500�������� @�      N   7   x�3�tL����,.)JL�/�t�2��M-N-�2�9�3RӀN��,�X� �3m      @   �   x�e�1N�0E�?�� h��vB:h���v��XAkG!�"N��PDr����X2�9�9C��ħ��|;�%��
�7�x�r�fὄ������{]����ivЬ*qIן�-�ʀ��)����㺡�+�`Ki�<R����ҨRjl>l�#��T�����Rj���=�w�C���F�RaG��;�֕F�҈B��b�JcJ�H)�R��f��4n�՝.'"�A�|-     