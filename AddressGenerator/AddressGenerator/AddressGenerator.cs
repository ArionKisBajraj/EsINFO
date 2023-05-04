public class AddressGenerator : IAddress
{
    private readonly int bits;

    public AddressGenerator(int bits)
    {
        if (bits != 32)
        {
            throw new ArgumentException("La classe AddressGenerator supporta solo indirizzi a 32 bit.");
        }

        this.bits = bits;
    }

    public string generateIPv4()
    {
        // Generate a random 32-bit integer
        int address = new Random().Next(0, int.MaxValue);

        // Converte il ​​numero intero in una stringa di indirizzo IPv4
        string ipv4 = $"{(address >> 24) & 255}.{(address >> 16) & 255}.{(address >> 8) & 255}.{address & 255}";

        return ipv4;
    }

    public string generateSubnet()
    {
        // Genera una subnet mask casuale
        int subnetMask = new Random().Next(0, 32);
        string subnet = new string('1', subnetMask) + new string('0', 32 - subnetMask);

        // Converte la subnet mask in una stringa di indirizzo IPv4
        string ipv4 = $"{Convert.ToInt32(subnet.Substring(0, 8), 2)}.{Convert.ToInt32(subnet.Substring(8, 8), 2)}.{Convert.ToInt32(subnet.Substring(16, 8), 2)}.{Convert.ToInt32(subnet.Substring(24, 8), 2)}";

        return ipv4;
    }
}

public interface IAddress
{
    string generateIPv4();
    string generateSubnet();
}
