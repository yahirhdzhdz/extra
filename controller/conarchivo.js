var operaciones="../model/modarchivo.php";
var archivo = new Vue({    
  el: "#archivo",   
  data:{    
    ctImagenes:[],
    ctArchivo:[],
    imagen:"",
    urlIns:"",
    urlUpd:"",
    borrar:"",
  },     
  methods:{
    insertar:function(){
      this.imagen=document.getElementById("flInsimagen").files[0];
      if(this.imagen==null){
        this.mserror();
      }else{
        let insert=new FormData();
        insert.append("opcion",2);
        insert.append("imagen",this.imagen);
        axios.post(operaciones,insert).then(response=>{
          this.listaarchivo();
          this.msinsert();
          this.limpiarIns();
        });
      }
    },
    cargarvalue:function(clave,imagen){
      this.clave=clave;
      this.urlUpd='../src/img/'+imagen;
      this.borrar=this.urlUpd;
    },
    editar:function(){
      this.imagen=document.getElementById("flUpdimagen").files[0];
      let update =new FormData();
      if(this.imagen!=null){
        update.append("opcion",3);
        update.append("clave",this.clave);
        update.append("imagen",this.imagen);
        update.append("borrar",this.borrar);
        axios.post(operaciones,update).then(response =>{
          this.listaarchivo();
          this.msupdate();
        });
      }
    },
    eliminar:function(clave,imagen){
      this.borrar='../src/img/'+imagen;
      let delet=new FormData();
      delet.append("opcion",4);
      delet.append("clave",clave);
      delet.append("borrar",this.borrar);
      Swal.fire({
        text: "¿Esta seguro de eliminar este registro?:"+clave,
        imageUrl: '../src/img/multimedia/eliminar.png',         
        imageWidth: 100,
        imageHeight: 100,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText:'Cancelar',          
        confirmButtonColor:'#13CBBA',          
        cancelButtonColor:'#CB131B',  
      }).then((result) => {
        if (result.value) {            
          axios.post(operaciones,delet).then(response =>{           
            this.listaarchivo();
          }),             
          Swal.fire(
            '¡Eliminado!',
            'El registro ha sido borrado.',
            'success'
          )
        }
      })
    },
    imgInsert:function(e){
      this.imagen=document.getElementById("flInsimagen").files[0];
      if(this.imagen.type=="image/jpeg" ||this.imagen.type=="image/png" ||this.imagen.type=="image/jpg"){
        var filereader = new FileReader();
        filereader.readAsDataURL(e.target.files[0])
        filereader.onload = (e) => {
          archivo.urlIns = e.target.result
      }
      }else{
        this.mserror("Archivo no admitido");
      }
    },
    imgUpd:function(e){
      this.imagen=document.getElementById("flUpdimagen").files[0];
      if(this.imagen.type=="image/jpeg" ||this.imagen.type=="image/png" ||this.imagen.type=="image/jpg"){
          var filereader = new FileReader();
          filereader.readAsDataURL(e.target.files[0])
          filereader.onload = (e) => {
            archivo.urlUpd = e.target.result
          }
      }else{
            this.mserror("Archivo no admitido");
      }
    },
    listaarchivo:function(){
      let consarchivo=new FormData();
      consarchivo.append("opcion",1);
      axios.post(operaciones,consarchivo).then(response =>{
        this.ctArchivo=response.data;   
      });
    },
    // listaproveedores:function(){
    //   let consproveedores=new FormData();
    //   consproveedores.append("opcion",2);
    //   axios.post(operaciones,consproveedores).then(response =>{
    //     this.ctProveedores=response.data;   
    //   });
    // },
    limpiarIns:function(){
      this.urlIns=null;
    },
    mserror:function(){
      Swal.fire({
        text: 'Existen campos vacios',
        imageUrl: '../src/img/multimedia/error.png',
        imageWidth: 100,
        imageHeight: 100,
        imageAlt: 'Custom image',
        confirmButtonText: 'Aceptar', 
        confirmButtonColor:'#13CBBA',
      })
    },
    msinsert:function(){
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });
        Toast.fire({
          type:'success',
          title:'Imagen registrada'
        })
    },
    msupdate:function(){
      Swal.fire(
        'Actualizado',
        'El registro ha sido actualizado.',
        'success'
      )
    },
  }, 
  created:function(){
    this.listaarchivo();
    // this.listaproductos();
    // this.listaproveedores();
  }
});