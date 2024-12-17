@extends('frontend.app')

@section('title', 'Balance Sheet')

@section('content')

<div class="overflow-x-auto">
    <!-- Total Credit -->
    <div class="mt-4 text-left">
        <span class="font-semibold text-lg text-gray-800">Total Credit: </span>
        <span class="font-bold text-lg text-green-600">${{ number_format($totalCredit, 2) }}</span>
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
    <table id="balanceSheetTable" class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-md">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Debit</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Credit</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">Balance</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            @forelse ($transactions as $transaction)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        {{ \Carbon\Carbon::parse($transaction['transaction_date'])->format('Y-m-d') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">
                        ${{ number_format($transaction['debit'], 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                        ${{ number_format($transaction['credit'], 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold 
                               {{ $transaction['balance'] < 0 ? 'text-red-600' : 'text-green-600' }}">
                        ${{ number_format($transaction['balance'], 2) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-600">
                        No transactions found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $transactions->links() }}
    </div>

    <!-- Totals Section -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 border rounded-lg shadow bg-white">
            <h2 class="text-lg font-semibold text-gray-800">Total Credit</h2>
            <p class="text-2xl font-bold text-green-600">${{ number_format($totalCredit, 2) }}</p>
        </div>
        <div class="p-4 border rounded-lg shadow bg-white">
            <h2 class="text-lg font-semibold text-gray-800">Total Debit</h2>
            <p class="text-2xl font-bold text-red-600">${{ number_format($totalDebit, 2) }}</p>
        </div>
        <div class="p-4 border rounded-lg shadow bg-white">
            <h2 class="text-lg font-semibold text-gray-800">Current Balance</h2>
            <p class="text-2xl font-bold 
                      {{ $currentBalance < 0 ? 'text-red-600' : 'text-green-600' }}">
                ${{ number_format($currentBalance, 2) }}
            </p>
        </div>
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
        const table = document.getElementById('balanceSheetTable');
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
        doc.save('balance_sheet.pdf');
    });

    // XLS Download
    document.getElementById('downloadXLS').addEventListener('click', () => {
        const table = document.getElementById('balanceSheetTable'); // Get the table
        const wb = XLSX.utils.book_new(); // Create a new workbook
        const ws = XLSX.utils.table_to_sheet(table); // Convert table to worksheet
        XLSX.utils.book_append_sheet(wb, ws, 'BalanceSheet'); // Append worksheet to the workbook

        // Write the workbook and trigger download
        XLSX.writeFile(wb, 'balance_sheet.xlsx');
    });
</script>

@endsection
