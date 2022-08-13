<div>
    <table class="w-full divide-y divide-gray-200">
        <thead>
          <tr>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  referenceCode / transactionId
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Informacion Cliente
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Precio
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Estado
              </th>
              <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                
              </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @if($ventas->count())
                @foreach($ventas as $i => $venta) 
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-500">{{$venta->referenceCode}}</div>
                            <div class="text-sm text-gray-900">{{$venta->transactionId}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-500">{{$venta->buyerEmail}}</div>
                            <div class="text-sm text-gray-900">{{$venta->processingDate}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-900">${{$venta->TX_VALUE}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if ($venta->transactionState == 4)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{$venta->lapTransactionState}}
                                </span>
                            @elseif ($venta->transactionState == 6)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{$venta->lapTransactionState}}
                                </span>
                            @elseif ($venta->transactionState == 7 || $venta->transactionState == 14 )
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-yellow-700">
                                    {{$venta->lapTransactionState}}
                                </span>
                                
                            @endif
                            <div class="text-sm text-gray-500">{{$venta->lapResponseCode}}</div>
                        </td>
                      </tr>
                @endforeach
                 
            @else
                <tr>
                    <td colspan="6">
                        <div class="alert alert-warning">
                            No se encontraron ventas
                        </div>
                    </td>
                </tr>
            @endif
          
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5" class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> {{ $ventas->links() }}</td>
          </tr>
        </tfoot>
      
    </table>
</div>
