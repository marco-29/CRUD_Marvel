<section>
    <div class="container mt-5">
        <div class="row text-center">
            <h1>Documentacion de integracion <br> de API Marvel y crear CRUD en CI4</h1>
        </div>
    </div>
</section>

<section>
    <div class="container mt-5">
        <div class="row">
            <h2>Consumo de API</h2>
            <p>Para este CRUD se requiere de una API otorgada por MARVEL en <a href="https://developer.marvel.com/" target="_blank">https://developer.marvel.com/</a></p>
            <h3>Pasos a seguir para poder consumir API</h3>
            <ol>
                <li>
                    Obtener Key creando una cuenta en <a href="https://developer.marvel.com/account" target="_blank">https://developer.marvel.com/account</a>
                    <ul>
                        <li>Al crear una cuenta se otorgara la public key y la private key, estas key serán esenciales para poder consumir la API.</li>
                    </ul>
                </li>
                <li>
                    Probar el endpoint junto con las keys otorgadas(es importante primero realizar el paso 1) en <a href="https://developer.marvel.com/docs" target="_blank">https://developer.marvel.com/docs</a>
                    <ul>
                        <li>Una ves que se sabe que endpoint se utilizara se puede utilizar POSTMAN y asi visualizar los datos que retorna el endpoint con las keys correspondientes. <a href="#postman">Probar API con POSTMAN</a></li>
                    </ul>
                </li>
                <li><a href="#consumir">Consumir API en CI4</a></li>
            </ol>
        </div>
    </div>
</section>

<section id="postman">
    <div class="container mt-5">
        <div class="row">
            <h2>Probar API con POSTMAN</h2>

            <p>Antes de consumir el API en el sistema es importante saber si el endpoint seleccionado concatenado con nuestras keys funciona correctamente y nos devuelve datos, en este caso utilice la herramienta POSTMAN.</p>

            <p>Para esto cree una carpeta llamada API MARVEL y dentro un request llamado personajes con el meotodo GET</p>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-5">
                <img src="<?php echo base_url('almacenamiento/recursos/postman/carpeta.png') ?>" alt="" class="img-fluid">
            </div>

            <p>En el request realice la prueba con el metodo GET ya que la API es de tipo REST y para que funcione solo permite el metodo GET.</p>

            <p>Para que el API funcione correctamente es necesario concatenar endpoint+ts+apikey+hash, El hash es md5 de la concatenacion de ts+privatekey+publickey. <br> Para generar hash utilice: <a href="https://www.md5hashgenerator.com/" target="_blank">https://www.md5hashgenerator.com/</a></p>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-5">
                <img src="<?php echo base_url('almacenamiento/recursos/postman/metodo.png') ?>" alt="" class="img-fluid">
            </div>

            <p>En mi caso utilice el endpoint para consumir los personajes de marvel y al probarlo con POSTMAN me devuelve el estatus <span class="t-verde">200(OK)</span> y los datos de los personajes:</p>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-5">
                <img src="<?php echo base_url('almacenamiento/recursos/postman/datos.png') ?>" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<section id="consumir">
    <div class="container mt-5">
        <div class="row">
            <h2>Consumir API en CI4</h2>
            <p>teniendo en cuenta que es una aplicación desde cero se realizaron las siguientes configuraciones en CI4:</p>
            <ul>
                <li>
                    Se renombro el archivo env a .env y dentro de este se descomentaron las lineas:
                    <ul>
                        <li><code>CI_ENVIRONMENT = production</code> y se cambio a <code>CI_ENVIRONMENT = development</code>, esto para mostrara los errores en la aplicacion </li>
                        <li>app.baseURL = '' para agregarle la url de la aplicacion app.baseURL = 'http://localhost:8888/CRUD_Marvel/public/' y asi utilizarla en las redirecciones o al momento de utilizar una img.</li>
                    </ul>
                    En este mismo archivo se agregaron 2 variables para almacenar las keys de la API y asi cada ves que queramos cambiar la key solo se cambiara en este archivo. <br>
                    <code>marvelapi.publickey = "aqui ongrese la clave publica"<br>
                        marvelapi.privatekey = "aqui la clave privada"</code>
                </li>
                <li>Se creo en app/config/ el archivo MarvelApi.php en el cual se declararon variables public para obtener las key de la API de mrvel, se obtienen de .env <br>
                    <code>
                        public $publickey;<br>
                        public $privatekey;</code>
                </li>
                <li>Se creo en Lbreries un archivo llamado ApiMarvel.php en el cual:
                    <ol>
                        <li>Se creo un constructor para crear las variables para los parametros de la API: <br>
                            <pre><code>
                                $this->curl = Services::curlrequest(['baseURI' => 'https://gateway.marvel.com:443/v1/public/']); // Se usa CURLREQUEST la cual ya nos la brinda codeigniter y ademas se crea un array donde se almacena el endpoint principal de marvel con ayuda de baseURI el cual nos lo brinda codeigniter4
                                $this->ts = Time::now()->getTimestamp(); //timestamp tare fecha y hora exacta
                                $this->hash = hash('md5', $this->ts. config('MarvelApi')->privatekey. config('MarvelApi')->publickey); //cifrar de tipo md5 concatenando ts+ privaekey + publickey las cuales las mandamos a traer de .env
                            </code></pre>
                        </li>
                        <li>Se creo una funcion para obtener los personajes y retornalos al controlador crud: <br>
                            <pre><code>
                                //Se crean parametros necesarios para la consulta
                                $params = [
                                'ts' => $this->ts,
                                'apikey' => config('MarvelApi')->publickey,
                                'hash' => $this->hash,
                                ];

                                $query = http_build_query($params);

                                $result = $this->curl->get('characters?'.$query); //Se hace la solicitud con metodo GET ya que la API solo permite este metodo.

                                $json_body = json_decode($result->getBody(), true); //Se decifra el json de los personajes que nos devuelve la API

                                //Aqui extraigo el solo el result del json ya que es lo unico que se utilizara, el results esta dentro de data entonces primero se extrae data y despues results
                                $results = $json_body['data']['results'];

                                //Aqui se crea un arreglo vacio para los persoanjes
                                $personajes = [];

                                //Se recorre el results por medio de foreach para almacenar el id y nombre de los personajes en el arreglo personajes
                                foreach ($results as $key => $personaje) {
                                $personajes[] = [
                                'id' => $personaje['id'],
                                'name' => $personaje['name'],
                                'description' => $personaje['description'],
                                ];
                                }

                                return $personajes; //Se hace retorno del arreglo para verificar si funciona, esto en el controlador crud
                            </code></pre>
                        </li>
                        <li>En el controlador Crud.php se creo variables protected para gestionar nuestra API y se creo un constructor para hacer la instancia de ApiMarvel, en el se usaron las variables protected para instanciar los datos del api y para la DB donde se guardaran los datos de la API <br>
                            <pre><code>
                                public function __construct()
                                {
                                    $this->api = new ApiMarvel();
                                    $this->personajes = new Personajes_model();
                                }
                            </code></pre>
                            Para despues crear una funcion index en la cual se almacena el array de persnajes en la variable personajes ya si manipular mas facil los datos, obtengo los datos de la DB para despues validar si está llena y si no es asi inseertar los datos del API, la validadcion se hace con la finalidada de insertar losd atos una sola ves.
                            <pre><code>
                                public function index()
                                {

                                    //Se almacena el array de persnajes en la variable personajes ya si manipular mas facil los datos
                                    $personajes = $this->api->obtener_personajes();

                                    //Se obtiene datos de DB para despues verificar si ya esta llena
                                    $modelo = $this->personajes;
                                    $query = $modelo->obtener_tabla();
                                    $db_llena = $query->getResultArray();

                                    //Validacion de que si la DB ya esta llena, si no es asi almacena los datos del API si ya esta llena ya no lo hara, esto se hizo con la finalidad de que solo una vez se agreguen los datos de la API.
                                    if (!$db_llena) {
                                        foreach ($personajes as $key => $personaje) {
                                            $data = [
                                                'identificador' => $personaje['id'],
                                                'nombre'    => $personaje['name'],
                                                'descripcion'    => $personaje['description'],
                                                'fecha_registro'    => date('Y'),
                                            ];

                                            $this->personajes->insert($data);
                                        }
                                    }

                                    //Data para despues mostrarla en la vista
                                    $data['db_llena'] = $db_llena;
                                    $data['personajes'] = $personajes;

                                    //Se dirige a la view home para mostrar los personajes los culaes se obtienen de la instancia api que esta en ApiMarvel en el metodo obtener_personajes 
                                    // return view('crud', [
                                    //     'personajes' => $this->api->obtener_personajes(),
                                    // ]);
                                    echo view('_layouts/header');
                                    echo view('crud/index', $data);
                                    echo view('_layouts/footer');
                                }
                            </code></pre>
                            Despues de esto se muestran los personajes en la vista CRUD y seguircon las funciones basicas de un CRUD.
                        </li>
                    </ol>
                </li>
            </ul>
        </div>
    </div>
</section>