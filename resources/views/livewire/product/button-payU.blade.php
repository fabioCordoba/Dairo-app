<form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
    <input name="merchantId"      type="hidden"  value="{{$merchantId}}"   >
    <input name="accountId"       type="hidden"  value="{{$accountId}}" >
    <input name="description"     type="hidden"  value="{{$description}}"  >
    <input name="referenceCode"   type="hidden"  value="{{$referenceCode}}" >
    <input name="amount"          type="hidden"  value="{{$total}}"   >
    <input name="tax"             type="hidden"  value="0"  >
    <input name="taxReturnBase"   type="hidden"  value="0" >
    <input name="currency"        type="hidden"  value="COP" >
    <input name="signature"       type="hidden"  value="{{$signature}}"  >
    <input name="test"            type="hidden"  value="1" >
    <input name="buyerEmail"      type="hidden"  value="{{Auth::user()->email}}" >
    <input name="responseUrl"     type="hidden"  value="{{ URL::to('/') }}/response" >
    <input name="confirmationUrl" type="hidden"  value="{{ URL::to('/') }}/confirmation" >
    <input name="shippingAddress"    type="hidden"  value="{{$orden->shippingAddress}}">
    <input name="shippingCity"       type="hidden"  value="{{$orden->shippingCity}}" >
    <input name="shippingCountry"    type="hidden"  value="CO"  >
    <input name="Submit"          type="submit"  value="Continuar con el Pago" class="flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
  </form>