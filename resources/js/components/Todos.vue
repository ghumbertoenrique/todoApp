<template>
  <div>
    <nav aria-label="Page navigation example">
    </nav>
    <h2>Cosas por Hacer</h2>
    <form @submit.prevent="addTodo" class="mb-3">
      <div class="form-group ">
        <input type="text" class="form-control mb-2" placeholder="Que vamos a hacer hoy?" v-model="todo.titulo">
        <input type="text" class="form-control mb-2" placeholder="Informacion Extra sobre la actividad" v-model="todo.descripcion">

      </div>
      <button type="submit"  class="btn btn-light btn-block mb-2"> Guardar </button>

    </form>

    <ul class="pagination">
      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
        <a class="page-link"  href="#" @click="fetchTodos(pagination.prev_page_url)">Anterior</a></li>

        <li class="disabled page-item"><a class="page-link text-dark" href="#">{{pagination.current_page}} de {{pagination.last_page}}</a></li>

        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
          <a class="page-link" href="#" @click="fetchTodos(pagination.next_page_url)" >Siguiente</a></li>

          <input class=" ml-3 pa-2" type="text" v-model="n" placeholder="Buscas algo?" >

          <li class=" ml-3 page-item">
            <button class="page-link"  @click="listCheck(1)" >Pendientes</button>
          </li>
          <li  class=" ml-3 page-item">
            <button class="page-link"  @click="listCheck(0)" > Resueltas </button>
          </li>
          <li class=" ml-3 page-item">
            <button class="page-link"  @click="listCheck(2)" >Todas</button>
          </li>
      </ul>

        <!-- Todos -->

        <div v-bind:class="[{noVisible: visible == todo.estado }]" class="visible card card-body mb-2 row" v-for="todo in filteresTodos" v-bind:key="todo.id" >
          <div class="row container">
            <div class="col-10">
              <h3>{{todo.titulo}}</h3>
              <p>{{todo.descripcion}}</p>
            </div>
            <div class="mb-2 col-2 text-right" >
              <button v-if="todo.estado == false" @click="changeEstado(todo)" class="btn btn-danger">Pendiente</button>
              <button v-else @click="changeEstado(todo)" class="btn btn-success">Resuelta</button>
            </div>
          </div>
          <button class="btn btn-warning mb-2" @click="editTodo(todo)" > Editar </button>
          <button class="btn btn-danger mb-2" @click="deleteTodo(todo.id)" > Borrar </button>
        </div>
  </div>
</template>


<script>
  export default{
    data(){
      return{
        todos:[],
        todo: {
          id:'',
          titulo:'',
          descripcion:'',
          estado: 0
        },
        todo_id:'',
        pagination:{},
        editando: false,
        n: '',
        visible: ''

      }
    },

    created(){
      this.fetchTodos();
    },

    methods:{
      fetchTodos(page_url){
        let vm = this;
        page_url = page_url || 'api/todos'
        fetch(page_url)
          .then(res => res.json())
          .then(res => {
            this.todos = res.data;
            vm.makePagination(res.meta, res.links );
          })
          .catch(err=> console.log(err));
      },

      makePagination(meta, links){
        let pagination = {
          current_page: meta.current_page,
          last_page: meta.last_page,
          next_page_url: links.next,
          prev_page_url: links.prev
        }
        this.pagination = pagination;
      },
      deleteTodo(id){
        if(confirm('Estas seguro?')){
          fetch(`api/todo/${id}`, {
            method:'delete'
          })
          .then(res => res.json())
          .then(data => {
            alert('Se elimino la actividad');
            this.fetchTodos()
          })
          .catch(err=>console.log(err))
        }
      },

      addTodo(){

        if(this.editando === false){
          //agrega
          if(this.todo.titulo==='' && this.todo.descripcion===''){
              alert('No puedes crear algo vacio');
          } else{

          fetch('api/todo', {
            method:'post',
            body: JSON.stringify(this.todo),
            headers:{
              'content-type':'application/json'
            }
          })
          .then(res => res.json)
          .then(data =>{
            this.todo.titulo = '';
            this.todo.descripcion = '';
              alert('Actividad Creada');
              this.fetchTodos();
          })
          .catch(err => console.log(err));
        }
        } else {
          //edita
          fetch('api/todo', {
            method:'put',
            body: JSON.stringify(this.todo),
            headers:{
              'content-type':'application/json'
            }
          })
          .then(res => res.json)
          .then(data =>{
            this.todo.titulo = '';
            this.todo.descripcion = '';
            this.editando = false;
            this.todo.todo_id = '';
              alert('Actividad Actualizada');
              this.fetchTodos();
          })
          .catch(err => console.log(err));


        }
      },
      editTodo(todo){
        this.editando = true;
        this.todo.id = todo.id;
        this.todo.todo_id = todo.id;
        this.todo.titulo = todo.titulo;
        this.todo.descripcion = todo.descripcion;
      },
      changeEstado(todo){
        this.todo.id = todo.id;
        todo.estado = !todo.estado;
        console.log(JSON.stringify(todo));
        fetch(`api/todo/${todo.id}`, {
          method:'put',
          body: JSON.stringify(todo),
          headers:{
            'content-type':'application/json'
          }
        })
        .then(res => res.json)
        .then(data =>{
          this.fetchTodos();
        })
        .catch(err => console.log(err));
      },
      listCheck(e){

        if(e === 0){
          this.visible = false;
       }else if (e === 1){
         this.visible = true;
       }else if (e === 2){
         this.visible = null;
       }
      }
    },
    computed:{
      filteresTodos(){
        return this.todos.filter(todo =>{
          return todo.titulo.toLowerCase().includes(this.n.toLowerCase())
        })
      }
    }
}

</script>
