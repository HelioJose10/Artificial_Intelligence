from hashlib import md5, sha256

# Criando um Hash simples
texto = "senha123".encode("utf8")
hash = md5(texto).hexdigest()
print("------------------------------")
print("Hash de um Texto:")
print(hash)
print("------------------------------")

# Transformando arquivos em hash
def getHashFromFile(file):
    hash = sha256()
    b = bytearray(128*1024)
    mv = memoryview(b)
    with open(file, "rb", buffering=0) as f:
        for n in iter(lambda : f.readinto(mv), 0):
            hash.update(mv[:n])
    return hash.hexdigest()

hash = getHashFromFile("README.md")
print("")
print("------------------------------")
print("Criar hash de um ficheiro:")
print(hash)
print("------------------------------")
