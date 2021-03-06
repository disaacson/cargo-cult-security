import cargocult.Authentication;

import javax.crypto.*;
import javax.crypto.spec.IvParameterSpec;
import java.io.UnsupportedEncodingException;
import java.security.InvalidAlgorithmParameterException;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;
import java.util.Random;

public class Main {
  public static void main(String[] args) throws BadPaddingException, InvalidKeyException, IllegalBlockSizeException, InvalidAlgorithmParameterException, UnsupportedEncodingException, NoSuchAlgorithmException, NoSuchPaddingException {
    System.out.println("Cargo Cult Security\n");

    String plainTextId = "100000";
    String cipherTextId = Authentication.getPrivateURL(plainTextId);
    System.out.println("Private URL param: " + cipherTextId + "\n");

    plainTextId = Authentication.decryptPrivateURL(cipherTextId);
    System.out.println("Decrypted ID: " + plainTextId + "\n");

    String maliciousCipherTextId = "3C2A754D0985";
    System.out.println("Malicious cipher text ID: " + maliciousCipherTextId);
    String maliciousPlainTextId = Authentication.decryptPrivateURL(maliciousCipherTextId);
    System.out.println("Decrypted malicious ID: " + maliciousPlainTextId + "\n");

    String hmac = Authentication.getHmac("important message");
    System.out.println("HMAC: " + hmac + "\n");

    String userID = "834";
    cipherTextId = Authentication.getPrivateURL(userID);
    System.out.println("Private URL param for user ID " + userID + " : " + cipherTextId + "\n");

    String foo = "foo";
    byte[] fooBytes = foo.getBytes();
    byte intermediateByte = (byte)(fooBytes[1] ^ "o".getBytes()[0] ^ "t".getBytes()[0]);
//    fooBytes[1] = (byte)(intermediateByte ^ "t".getBytes()[0]);
    fooBytes[1] = intermediateByte;
    String fooReconstituted = new String(fooBytes);
    System.out.println("Foo: " + fooReconstituted + "\n");

    new java.util.Random().nextLong();

    IvParameterSpec iv = new javax.crypto.spec.IvParameterSpec(fooBytes);
    SecretKey key = KeyGenerator.getInstance("DES").generateKey();

    Random secureRandom = new java.security.SecureRandom();
  }
}
