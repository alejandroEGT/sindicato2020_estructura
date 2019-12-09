export default {
  data() {
    return {
    //VARIABLES PARA EL STEPPER FORMULARIO
      step: 1,
      rut : '',
      monto : null,
      tipo : false,
      interes : null,
      fecha : '',
    //VARIABLES QUE RESCATAN AL USUARIO
     usuario: 'Bryan Vidal Díaz'
    };
  },
  methods: {
      calcularIntereses(){
          let valorConIneteres =  monto * intereses;
          console.log(valorConIneteres);
      }
  },
};