function formatTanggal(dateString) {
  const hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
  const bulan = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
  ];

  const date = new Date(dateString);
  const namaHari = hari[date.getDay()];
  const tanggal = date.getDate();
  const namaBulan = bulan[date.getMonth()];
  const tahun = date.getFullYear();

  return `${namaHari}, ${tanggal} ${namaBulan} ${tahun}`;
}
function formatRupiahConvert(angka) {
  if (angka == null || angka === "") return "Rp 0";

  // Pastikan angka adalah number, jika tidak ubah menjadi number
  let angkaFormat = parseFloat(angka);

  // Mengecek apakah hasilnya adalah angka yang valid
  if (isNaN(angkaFormat)) return "Rp 0";

  // Format angka dengan locale Indonesia untuk pemisah ribuan dan koma desimal
  return (
    "Rp. " +
    angkaFormat.toLocaleString("id-ID", {
      // minimumFractionDigits: 2,
      // maximumFractionDigits: 2,
    })
  );
}
