<div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl w-full max-w-md p-6 animate-fadeIn">
        <h2 class="text-xl font-bold mb-4">{{ $title }}</h2>
        <div id="modalContent" class="text-sm space-y-2"></div>
        <button onclick="closeModal()"
            class="mt-4 w-full bg-primary text-white py-2 rounded cursor-pointer">
            Tutup
        </button>
    </div>
</div>
<script>
function closeModal() {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
<style>
@keyframes fadeIn {
    from {opacity:0; transform:scale(0.95);}
    to {opacity:1; transform:scale(1);}
}
.animate-fadeIn {
    animation: fadeIn .2s ease;
}
</style>