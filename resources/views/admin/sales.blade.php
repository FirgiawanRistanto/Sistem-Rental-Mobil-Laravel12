@extends('layouts.app')

@section('title', 'Sales Data')

@section('content')
<div class="container mx-auto p-4 sm:p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Sales Management</h1>
        <a href="#" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
            + Add Sale
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left text-sm font-semibold uppercase">Product Name</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold uppercase">Price</th>
                        <th class="py-3 px-6 text-center text-sm font-semibold uppercase">Quantity</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold uppercase">Total Price</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold uppercase">Date</th>
                        <th class="py-3 px-6 text-center text-sm font-semibold uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($sales as $sale)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                            <td class="py-4 px-6 truncate" title="{{ $sale->product_name }}">{{ $sale->product_name }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">Rp {{ number_format($sale->price, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-center whitespace-nowrap">{{ $sale->quantity }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">Rp {{ number_format($sale->price * $sale->quantity, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">{{ $sale->created_at->format('d M Y') }}</td>
                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium mr-3 transition duration-150">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-800 font-medium transition duration-150">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">
                                No sales data found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

