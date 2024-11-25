
<div class="bg-gray-100 font-sans">
 
    <!-- Filters and Grid -->
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex space-x-4 text-gray-600">
                <span>Apartment</span>
                <span>&gt;</span>
                <span>Flat</span>
                <span>&gt;</span>
                <span>Housing</span>
                <span>&gt;</span>
                <span>USA</span>
            </div>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded">Filter</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php for ($i = 0; $i < 9; $i++): ?>
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <div class="h-48 bg-gray-300 rounded-md mb-4"></div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-lg font-semibold">$1000 - $2000 USD</span>
                        <button class="text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-gray-700">Well Furnished Apartment</p>
                    <div class="flex justify-between items-center mt-2 text-gray-500">
                        <span>4.5 stars</span>
                        <span>Location</span>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="text-center mt-6 text-gray-500">Pagination or Load more...</div>
    </div>
</div>
</html>
