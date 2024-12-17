@extends('frontend.app')
@section('title', 'internal credit')
{{-- @push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/checkout.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endpush --}}

@section('content')
<div class="overflow-x-auto">
      <!-- Total Credit -->
      <div class="mt-4 text-left">
        <span class="font-semibold text-lg text-gray-800">Total Credit: </span>
        <span class="font-bold text-lg text-green-600">${{ number_format($totalCredit, 2) }}</span>

      
    </div>
    <div class="mt-4 text-right">
        
        <span class="font-semibold text-lg text-gray-800">Current Credit: </span>
        <span class="font-bold text-lg text-green-600">${{ Auth()->user()->credit }}</span>
    </div>

    <!-- Download Buttons -->
    <div class="mt-6 flex justify-end gap-4">
        <button id="downloadPDF" 
           class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded shadow">
           Download PDF
        </button>
        <button id="downloadXLS" 
           class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded shadow">
           Download XLS
        </button>
    </div>
    <!-- Table -->
    <table id="creditTable" class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-md">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">From Order</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Credit Balance</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            @forelse ($credits as $credit)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        Order #{{ $credit->order_id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">
                        ${{ number_format($credit->credit_amount, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($credit->date)->format('Y-m-d') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-600">
                        No credit records found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $credits->links() }}
    </div>

  
</div>

<!-- JS Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>


<script>
    // PDF Download
    document.getElementById('downloadPDF').addEventListener('click', () => {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Extract table headers and rows
        const table = document.getElementById('creditTable');
        const rows = table.querySelectorAll('tr');

        let data = [];
        rows.forEach((row) => {
            let rowData = [];
            row.querySelectorAll('td, th').forEach((cell) => {
                rowData.push(cell.textContent.trim());
            });
            data.push(rowData);
        });

        // Use autoTable to generate the PDF table
        doc.autoTable({
            head: [data[0]], // Table headers
            body: data.slice(1), // Table rows
            theme: 'grid', // Table theme (optional)
        });

        // Save the PDF
        doc.save('credits.pdf');
    });

    // XLS Download
    document.getElementById('downloadXLS').addEventListener('click', () => {
        const table = document.getElementById('creditTable'); // Get the table
        const wb = XLSX.utils.book_new(); // Create a new workbook
        const ws = XLSX.utils.table_to_sheet(table); // Convert table to worksheet
        XLSX.utils.book_append_sheet(wb, ws, 'Credits'); // Append worksheet to the workbook

        // Write the workbook and trigger download
        XLSX.writeFile(wb, 'credits.xlsx');
    });
</script>





@endsection