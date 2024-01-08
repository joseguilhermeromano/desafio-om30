<template>
  <q-page class="row items-center justify-evenly">
    <div class="row exemplo">
      <div class="col-12 text-center mb-3">
        <h5 class="font-weight-bold">Criando um formulário com vue</h5>
      </div>
      <div class="form-group col-6 offset-3">
        <label for="">Cep</label>
        <input v-model="cep" placeholder="Digite seu cep"
          type="text" maxlength="8"
          class="form-control">
      </div>
      <div v-if="endereco !== null" class="form-group col-6 offset-3">
        <div class="my-1" v-for="(value, index) in filteredEndereco" :key="index">
          <label :for="index">{{index.toUpperCase()}}</label>
          <input
            class="form-control"
            :placeholder="index"
            v-model="endereco[index]"
            type="text"
          />
        </div>
      </div>
      </div>
  </q-page>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios'

export default defineComponent({
  name: 'IndexPage',
  data(){
    return {
      cep: '',
      endereco: null,
      baseUrl: 'https://viacep.com.br/ws/'
    }
  },
  methods:{
    getCep () {
          const url = `${this.baseUrl}${this.cep}/json/`
          axios.get(url).then((resp) => {
            const data = resp.data
            if (!data.erro) {
              this.endereco = data
            } else {
              alert('Cep não encontrado')
            }
          }).catch( (error:string) => {
            console.error(error)
          })
        }
  },
  watch: {
    cep: function (novoCep, velhoCep) {
      if (novoCep.length === 8) this.getCep()
      else this.endereco = velhoCep
    }
  },
  computed: {
    filteredEndereco(this: { endereco: Record<string, string> }) {
      // Agora TypeScript sabe que 'this' tem uma propriedade 'endereco'
      return Object.keys(this.endereco).filter(index => index !== 'cep');
    },
  },
});
</script>
