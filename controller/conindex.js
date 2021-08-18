var operaciones="../model/modindex.php";
var index = new Vue({    
  el: "#index",   
  data:{    
    ctTPUsuario:[],
    ctComentarios:[],
    nombre:"",
    paterno:"",
    materno:"",
    email:"",
    password:"", 
    idimagen:"",
    idusuario:"",
    comentario:"",
  },     
  methods:{
    insertardatos:function(){
      this.nombre=document.getElementById("txtNombre").value;
      this.paterno=document.getElementById("txtPaterno").value;
      this.materno=document.getElementById("txtMaterno").value;
      this.email=document.getElementById("txtEmail").value;
      this.password=document.getElementById("txtPassword").value;
      if(this.nombre==0 || this.paterno==0 || this.materno==0 || this.email==0 || this.password==0){
        this.mserror();
      }else{
        cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!cadena.test(this.email)){
          this.msemail();
        }else{
          axios.post(operaciones,{opcion:3,nombre:this.nombre,paterno:this.paterno,materno:this.materno,email:this.email,password:this.password}).then(response =>{
            this.msinsert("Datos guardados");
            this.limpiarregistro();
          });
        }
      }
    },
    iniciarsesion:function(){  
      this.rool=document.getElementById("cmbRool").value;
      this.email=document.getElementById("Email").value;
      this.password=document.getElementById("Password").value;
      if(this.email==0 || this.password==0 || this.rool==0){
        this.mserror();
      }else{
          cadena = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!cadena.test(this.email)){
            this.msemail();
            this.limpiarlogin();
          }else{
            axios.post(operaciones,{opcion:2,rool:this.rool,email:this.email,password:this.password}).then(response =>{
            if(response.data==null){
              this.msdenegado();
              this.limpiarlogin();
            }else{
              if(response.data=="AccessoConcedidoAdministrador"){
                window.location.href="menu.php";
              }else{
                window.location.href="index.php";
              }
            }
          });
        }
      }
    },  
    notas:function(){
      this.comentario=document.getElementById("txtcomentario").value;
      this.idimagen=document.getElementById("txtidimagen").value;
      this.idusuario=document.getElementById("txtidusuario").value;
      axios.post(operaciones,{opcion:4,comentario:this.comentario,idimagen:this.idimagen,idusuario:this.idusuario}).then(response =>{
        document.getElementById("txtcomentario").value=null;
        this.msinsert("Comentario agregado");
        window.location.href="http://localhost/Comentarios/view/imgdetalle.php?clave="+this.idimagen;
      });  
    },
    listatpusuarios:function(){
      axios.post(operaciones,{opcion:1}).then(response=>{
        this.ctTPUsuario=response.data;
      });
    },
    listacomentarios:function(){
      axios.post(operaciones,{opcion:5}).then(response=>{
        this.ctComentarios=response.data;
      });
    },
    limpiarlogin:function(){
      document.getElementById("Email").value=null;
      document.getElementById("Password").value=null;
      document.getElementById("cmbRool").value=0;
    },
    limpiarregistro:function(){
      document.getElementById("txtNombre").value=null;
      document.getElementById("txtPaterno").value=null;
      document.getElementById("txtMaterno").value=null;
      document.getElementById("txtEmail").value=null;
      document.getElementById("txtPassword").value=null;
    },
    msinsert:function(mensaje){
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
      });
      Toast.fire({
        type:'success',
        title:mensaje
      })
    },
    mserror:function(){
      Swal.fire({
        text:'Existen campos vacios',
        imageUrl: '../src/img/multimedia/error.png',
        imageWidth: 100,
        imageHeight: 100,
        imageAlt: 'Custom image',
        confirmButtonText: 'Aceptar', 
        confirmButtonColor:'#13CBBA',
      })
    },
    msemail:function(){
      Swal.fire({
        text: 'Email no valido',
        imageUrl: '../src/img/multimedia/email.png',
        imageWidth: 100,
        imageHeight: 100,
        imageAlt: 'Custom image',
        confirmButtonText: 'Aceptar', 
        confirmButtonColor:'#13CBBA',
      })
    },
    msdenegado:function(){
      Swal.fire({
        title: 'Acceso denegado',
        text: 'Verifica tu usuario y contraseña',
        imageUrl: '../src/img/multimedia/logo.png',
        imageWidth: 200,
        imageHeight: 200,
        imageAlt: 'Custom image',
        confirmButtonText: 'Aceptar', 
        confirmButtonColor:'#13CBBA',
      })
    },
  },
  created:function(){            
    this.listatpusuarios(); 
    this.listacomentarios();  
  }
});