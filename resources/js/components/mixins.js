export const GeneralVariables = {
    data: function () {
        return {
          pinturas: {}
        };        
    },
    methods:{
        configTema: function (){

            let url = '/api/config/tema';

            axios.post(url).then(response => {                
                
                tema = response.data[0];

            });

            

            

        },
        saludar: function(){
            console.log('Hola Hola');
        },
        despedirse: function (){
            console.log('despedirse');
        }
    }

};