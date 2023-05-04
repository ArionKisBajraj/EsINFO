class Program
{
    static void Main(string[] args)
    {
        // Crea un'istanza di AddressGenerator a 32 bit
        AddressGenerator generatore = new AddressGenerator(32);

        // Genera e stampa l'indirizzo ipv4
        string ipv4 = generatore.generateIPv4();
        Console.WriteLine($"Indirizzo IPV4 random: {ipv4}");

        // Genera e stampa la subnet mask
        string subnet = generatore.generateSubnet();
        Console.WriteLine($"Subnet mask: {subnet}");
    }
}
