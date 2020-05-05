
@extends('external.app.layout.layout-head')
@section('title', 'Inicio')
@section('content')
<div class="container-fluid" id="content-app">
  <!-- inicio ingresar codigo -->
  <div :class="$store.state.siguiente_info_conductor ? 'animated bounceOutLeft': 'animated bounceInLeft'" v-show="!$store.state.siguiente_info_conductor">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  col-centered">
          <div class="row  text-center" style="padding:10px;">
              <strong class="font-app">Ingresa tu ID o Correo Electrónico del Conductor</strong>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
                  <div class="input-group" style="display: flex;padding:10px;">
                    <input type="text"  id="id_driver" name="id_driver" maxlength="40" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control ph-center" placeholder="ID o CORREO"  v-model="$store.state.search">
                  </div>
                  <c-error>

                  </c-error>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
                  <div class="input-group" style="display: flex;padding:10px;">
                    <button type="button" :disabled="$store.state.search == ''" @click="$store.commit('infoDriver');$store.commit('getBanck')" class="btn btn-success btn-block " name="button" > <strong>Consultar</strong> </button>
                  </div>
            </div>
          </div>
    </div>
  </div>
  </div>
  <!-- fin ingresar codigo -->
<!-- incio info driver codigo -->
<div :class="$store.state.mostrar_info_conductor ? 'animated bounceInRight': 'animated bounceInLeft'"  v-show="$store.state.mostrar_info_conductor" >
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  col-centered">
    <div class="container-fluid">
      <div class="row  text-center" style="padding-top:10px;">
          <strong class="font-app">Su saldo es</strong>
      </div>
      <div class="row  text-center" style="padding:3px;">
          <h1><strong class="font-app" v-html="$store.state.type_money_info"></strong> <strong class="font-app" v-html="$store.state.saldo"></strong></h1>
      </div>
      <div class="row  text-center">
          <strong class="font-app">Puedes ganar hasta</strong>
      </div>
      <div class="row  text-center" >
          <h3><strong class="font-app" v-html="$store.state.type_money_info" > </strong> <strong class="font-app" v-html="$store.state.ganar_asta" > </strong></h3>
      </div>

    </div>

    <div class="container-fluid">
      <div class="row  text-center" style="padding-top:10px;">
          #<strong class="font-app" v-html="$store.state.id_office"></strong>
      </div>
      <div class="row  text-center" >
          <strong class="font-app"> Datos del Conductor </strong>
      </div>
      <div class="row  text-center" >
          <strong class="font-app" v-html="$store.state.first_name"></strong> <strong class="font-app" v-html="$store.state.last_name"></strong>
      </div>

    </div>





        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
                <div class="input-group" style="display: flex;padding:10px;">
                  <button type="button" @click="$store.commit('addSaldo')" class="btn btn-success btn-block " name="button" > <strong>Añadir Saldo</strong> </button>
                </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
                <div class="input-group" style="display: flex;padding:10px;">
                  <button type="button" @click="$store.commit('history')" class="btn btn-success btn-block " name="button" > <strong>Historial</strong> </button>
                </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
                <div class="input-group" style="display: flex;padding-top:80px;padding-button:10px;">
                  <button type="button" @click="$store.commit('backInfoDriver')" class="btn btn-success btn-block " name="button" > <strong>Atrás</strong> </button>
                </div>
          </div>
        </div>
  </div>
</div>
</div>
<!-- fin  info driver codigo -->

<!-- incio addSaldo codigo -->
<div :class="$store.state.mostrar_add_saldo ? 'animated bounceInRight': 'animated bounceInLeft'"  v-show="$store.state.mostrar_add_saldo" >
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  col-centered">

    <div class="container-fluid">
      <div class="row  text-center" style="padding-top:10px;">
          <strong class="font-app">ingrese el monto:</strong>
      </div>

      <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
              <div class="input-group" style="display: flex;padding:10px;">
                <select class="" name=""  v-model="$store.state.type_money_pay">
                  <option value="PEN">S/</option>
                  <option value="USD">$</option>
                </select>  <input type="number"  id="mount" name="mount" maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control ph-center" placeholder="Monto"  v-model="$store.state.add_monto">
              </div>
        </div>
      </div>

    </div>
    <div class="container-fluid">
      <div class="row  text-center" style="padding-top:10px;">
          <strong class="font-app">Selecciona forma de recarga.</strong>
      </div>

      <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
              <div class="input-group" style="display: flex;padding:10px;">
                <button type="button" :disabled="$store.state.add_monto == ''" @click="$store.commit('payCard')" class="btn btn-success btn-block " name="button" > <strong>Tarjeta de Débito o Crédito</strong> </button>
              </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
              <div class="input-group" style="display: flex;padding:10px;">
                <button type="button" :disabled="$store.state.add_monto == '' "  @click="$store.commit('payTrasferencia')" class="btn btn-success btn-block " name="button" > <strong>Trasferencia</strong> </button>
              </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
              <div class="input-group" style="display: flex;padding:10px;">
                <button type="button" :disabled="$store.state.add_monto == ''"  @click="$store.commit('payDeposito')" class="btn btn-success btn-block " name="button" > <strong>Depósito</strong> </button>
              </div>
        </div>
      </div>





    </div>

    <div class="container-fluid">
      <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
            <div class="input-group" style="display: flex;padding:10px;">
              <p class="font-app p-coment">
Todas las operaciones hechas a través de Transferencia o Depósito bancario tendrán un plazo maximo de Aprobación de 24 Horas. Para mayor información, por favor comunicarse con nuestro equipo de Soporte
              </p>
            </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
            <div class="input-group" style="display: flex;padding-top:80px;padding-button:10px;">
              <button type="button" @click="$store.commit('backAddSaldo')" class="btn btn-success btn-block " name="button" > <strong>Atrás</strong> </button>
            </div>
      </div>
    </div>




  </div>
</div>
</div>
<!-- fin  addSaldo codigo -->
<!-- incio trasferencia/posito codigo -->
<div :class="$store.state.mostrar_add_saldo_trasferencia ? 'animated bounceInRight': 'animated bounceInLeft'"  v-show="$store.state.mostrar_add_saldo_trasferencia" >
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  col-centered">
    <div class="container-fluid">
      <div class="row  text-center" style="padding-top:10px;">
          <strong class="font-app" v-html="$store.state.obj_type_pago.description"></strong>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row  text-center" style="padding-top:5px;">
          <strong class="font-app">Banco:</strong>
      </div>

      <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
              <div class="input-group" style="display: flex;padding:10px;">
                <select type="number"  id="id_banck" name="id_banck" class="form-control ph-center"  v-model="$store.state.id_banck">
                  <option v-for="item in $store.state.bancks" :value="item.id" v-html="item.name" ></option>
                </select>
              </div>
        </div>
      </div>

      <div class="row  text-center" style="padding-top:5px;">
          <strong class="font-app">Número de Operación:</strong>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
              <div class="input-group" style="display: flex;padding:5px;">
                <input type="number" class="form-control ph-center" maxlength="25" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="" value="">
              </div>
        </div>
      </div>

      <div class="row  text-center" style="padding-top:5px;">
          <strong class="font-app">Fecha y Hora:</strong>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
              <div class="input-group" style="display: flex;padding:10px;">
                <input type="date" class="form-control ph-center" name="" value="">
              </div>
        </div>
      </div>

      <div class="row  text-center" style="padding-top:5px;">
          <strong class="font-app">Comprobante:</strong>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
              <div class="input-group"  style="display: flex;padding:10px;">
                <input type="file" name="" class="form-control ph-center" value="">
              </div>
        </div>
      </div>


    </div>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
          <div class="input-group" style="display: flex;padding:10px;">
            <button type="button" :disabled="$store.state.add_monto == ''" @click="$store.commit('trasferenciaAction')" class="btn btn-success btn-block " name="button" > <strong>Enviar</strong> </button>
          </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
          <div class="input-group" style="display: flex;padding:10px;">
            <button type="button" :disabled="$store.state.add_monto == '' "  @click="$store.commit('backTrasferencia')" class="btn btn-success btn-block " name="button" > <strong>Atrás</strong> </button>
          </div>
    </div>
</div>





  </div>
</div>
</div>


</div>
<!-- fin  Transferencia/posito codigo -->

<!-- incio HISTORIAL codigo -->
<div :class="$store.state.mostrar_add_saldo_history ? 'animated bounceInRight': 'animated bounceInLeft'"  v-show="$store.state.mostrar_add_saldo_history" >
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  col-centered">
    <div class="container-fluid">

      <div class="row  text-center" style="padding-top:10px;">
          <strong class="font-app" >Historial</strong>
      </div>
    </div>
    <div class="container-fluid">

      <div class="row  text-center" style="padding-top:10px;">
          <strong class="font-app" >Filtro</strong>  <select type="number" @change="$store.commit('searchHistory')" id="id_filter" name="id_filter" class="form-control ph-center" v-model="$store.state.id_filter">
              <option value="Completado">Completado</option>
              <option value="Pendiente">Pendiente</option>
              <option value="Rechazdo">Rechazdo</option>
            </select>
      </div>
    </div>
    <div class="container-fluid">
        <div class="c-scroll">
          <table class="table">
          <thead>
            <tr>
              <th scope="col">Detalle</th>
            </tr>
          </thead>
          <tbody>
            <tr  v-for="(item , i) in $store.state.history">
              <th scope="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                  <div class="row">
                    <strong class="font-app" v-html="item.date_pay"></strong>
                  </div>

                <div class="row">
                  N° ope. <strong v-html="item.operacion" class="font-app"></strong>
                </div>
                  <div class="row">
                    T. Pago:<strong v-html="item.type_pay" class="font-app"></strong>
                  </div>

                  <div class="row">
                    <strong v-html="item.state" class="font-app"></strong>
                  </div>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <div class="row">
                    <strong v-html="item.type_money" class="font-app"></strong>
                    <strong v-html="item.mount" class="font-app"></strong>
                  </div>
                  <div class="row">
                    <i :class="item.state == 'Completado' ? 'fa fa-fw fa-check-circle fa-2x':(item.state == 'Pendiente' ? 'fa fa-fw  fa-exclamation-circle fa-2x':'fa fa-fw  fa-times-circle fa-2x')"></i>
                  </div>
                </div>
              </th>
            </tr>
            <tr>
          </tbody>
          </table>
        </div>

    </div>

    <div class="row">
      <div class="col-lg-6 col-md-8 col-sm-8 col-xs-10  col-centered text-center">
            <div class="input-group" style="display: flex;padding-top:80px;padding-button:10px;">
              <button type="button" @click="$store.commit('backHistory')" class="btn btn-success btn-block " name="button" > <strong>Atrás</strong> </button>
            </div>
      </div>
    </div>
</div>
</div>
</div>
<!-- fin  HISTORIAL codigo -->

</div>

</div>
@endsection
@section('script')


<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js')}} "></script>
<script src="{{ asset('js/External/app/infoRecarga.js')}} "></script>
@endsection
