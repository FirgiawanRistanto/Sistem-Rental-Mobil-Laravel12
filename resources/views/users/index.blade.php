<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.navigation')
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">User Management</h1>
            <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                + Add User
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="py-3 px-6 text-left text-sm font-semibold uppercase">Name</th>
                            <th class="py-3 px-6 text-left text-sm font-semibold uppercase">Email</th>
                            <th class="py-3 px-6 text-left text-sm font-semibold uppercase">Joined On</th>
                            <th class="py-3 px-6 text-center text-sm font-semibold uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($users as $user)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                                <td class="py-4 px-6 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="py-4 px-6 truncate" title="{{ $user->email }}">{{ $user->email }}</td>
                                <td class="py-4 px-6 whitespace-nowrap">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="py-4 px-6 text-center whitespace-nowrap">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-800 font-medium mr-3 transition duration-150">Edit</a>
                                    <a href="#" class="text-red-600 hover:text-red-800 font-medium transition duration-150">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
