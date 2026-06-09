print("=== Program Diskon Potongan Harga ===")

# Input total belanja
total_belanja = float(input("Masukkan total belanja (Rp): "))

# Logika untuk menentukan diskon
if total_belanja < 500000:
    diskon = 0.00
elif total_belanja < 2500000:
    diskon = 0.05
elif total_belanja < 5000000:
    diskon = 0.15
else:
    diskon = 0.30

# Menghitung jumlah potongan dan total bayar setelah diskon
potongan = total_belanja * diskon
total_bayar = total_belanja - potongan

# Output
print("\n====================================")
print(f"Selamat, Anda mendapat diskon {int(diskon * 100)}%")
print(f"Potongan Harga : Rp {potongan:,.0f}")
print(f"Total Bayar    : Rp {total_bayar:,.0f}")
print("====================================")