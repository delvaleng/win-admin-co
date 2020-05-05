

const store = new Vuex.Store({
  state:
  {
    siguiente_info_conductor:false,
    mostrar_info_conductor:false,

    mostrar_inicio:false,

    //add Saldo
    mostrar_add_saldo:false,
    add_monto:"",
    obj_type_pago : {},
    type_money_pay:"PEN",
    type_pago:
    [ {
        id:1,
        description:"TRASFERENCIA"
      },
      {
          id:2,
          description:"DEPOSITO"
      },
      {
          id:3,
          description:"PAGO TARJETA"
      },
    ],

    //trasnferencia
    mostrar_add_saldo_trasferencia:false,
    id_banck:1,

    bancks:[],

    //errors
  menssageError : "",
    error  : false,

    //codigo o email
    search:"",

    //info conductor
    id_office:"",
    type_money_info:"S/",
    saldo:0,
    ganar_asta:0,
    first_name:"sa",
    last_name:"max el",

    //history
    mostrar_add_saldo_history:false,
    id_filter:"Completado",
    history:[
      {
        date_pay:"03/02/2020",
        operacion:"2020202656565",
        type_pay:"tarjeta",
        state:"Completado",
        type_money:"S/",
        mount:"50",
      },
      {
        date_pay:"03/02/2020",
        operacion:"0000632323",
        type_pay:"Scotioabank",
        state:"Pendiente",
        type_money:"S/",
        mount:"20",
      },
      {
        date_pay:"12/02/2020",
        operacion:"2020202656565",
        type_pay:"tarjeta",
        state:"Rechazado",
        type_money:"S/",
        mount:"30",
      },
    ]

  },
  computed:
  {

  },
  mutations:
  {
    infoDriver()
    {
      let t = this;
      t.state.menssageError = "";
      t.state.search = t.state.search.toUpperCase();
                        axios.post('/searchConductor',{
                          pais   :  "PERU",
                          llave  :  t.state.search
                        })

                        .then(function (response) {
                          console.log(response);
                          if(response.data.object == 'error')
                          {
                            t.state.menssageError = response.data.message;

                            t.state.error  = true;
                          }else {
                            //datos del conductore
                             t.state.saldo = response.data.data.saldo_actual;
                             var s = t.state.saldo;
                             t.state.ganar_asta = Math.round(((s/0.15)), -1);
                             t.state.type_money_info = response.data.data.simbolo_moneda;
                             t.state.first_name =  response.data.data.first_name_driver;
                             t.state.last_name = response.data.data.last_name_driver;
                             t.state.id_office = response.data.data.id_office_driver;



                             t.state.siguiente_info_conductor = true;
                             setTimeout(() => { t.state.mostrar_info_conductor= true }, 400);

                          }

                        })
                        .catch(function (error) {
                        });
                        //datos del conductore



    },
    backInfoDriver()
    {
      let t = this;

      t.state.mostrar_info_conductor= false;
      t.state.siguiente_info_conductor = false;

    },
    searchHistory()
    {
      let t = this;
        return t.state.history.filter((item) => item.state.includes(t.state.id_filter));
    },
    addSaldo()
    {
      let t = this;
      t.state.mostrar_info_conductor= false;
      t.state.mostrar_add_saldo = true;
    },
    history()
    {
      let t = this;
        t.state.mostrar_info_conductor= false;
        t.state.mostrar_add_saldo_history=true;
    },
    backAddSaldo()
    {
      let t = this;
      t.state.mostrar_info_conductor= true;
        t.state.mostrar_add_saldo = false;
    },
    payTrasferencia()
    {
      let t = this;

      $.each( t.state.type_pago, function( key, value ) {
        if(value.id == 1)
        {
          t.state.obj_type_pago = value;
          return false;
        }
      });
      t.state.mostrar_add_saldo= false;
      t.state.mostrar_add_saldo_trasferencia = true;


    },
    payDeposito()
    {
      let t = this;

      $.each( t.state.type_pago, function( key, value ) {
        if(value.id == 2)
        {
          t.state.obj_type_pago = value;
          return false;
        }
      });
      t.state.mostrar_add_saldo= false;
      t.state.mostrar_add_saldo_trasferencia = true;


    },
    backTrasferencia()
    {
      let t = this;
      t.state.mostrar_add_saldo= true;
        t.state.mostrar_add_saldo_trasferencia = false;
    },
    getBanck()
    {
      let t = this;
      axios.post('/add/pay/get/banks',{

      })

      .then(function (response) {
        if(response.data.object == 'error')
        {
          t.state.arrayError = response.data.errors;

          t.state.error  = true;
        }else {

          t.state.bancks = response.data.data;
        }

      })
      .catch(function (error) {
      });
    },
    backHistory()
    {
      let t = this;
      t.state.mostrar_add_saldo_history = false;
      t.state.mostrar_info_conductor = true;
    }

  },



});

Vue.component('c-error',
{
  template:
  `<div v-bind:class="[$store.state.error ? 'bg-danger' : 'bg-success']">
      {{$store.state.menssageError}}
  </div>`,
}

);




  const contenerdor  = new Vue({
  el: '#content-app',
      store,
  data: {
   show: false
 }

})
