package cargocult;

import javax.crypto.BadPaddingException;
import javax.crypto.Cipher;
import javax.crypto.IllegalBlockSizeException;
import javax.crypto.NoSuchPaddingException;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.SecretKeySpec;
import java.io.UnsupportedEncodingException;
import java.security.InvalidAlgorithmParameterException;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;
import java.util.Arrays;

import static cargocult.Helper.*;

public class Authentication {
  static String key = "superSecretKey";
  static IvParameterSpec initVector = new IvParameterSpec(Arrays.copyOf("pseudoRandomBits".getBytes(), 8));
  static SecretKeySpec keySpec = new SecretKeySpec(key.getBytes(), "Blowfish");
  static Cipher cipher;

  static {
    try {
    } catch (Exception e) {
      System.out.println("Exception getting cipher " + e);
    }
  }

  public static String getPrivateURL() throws InvalidKeyException, BadPaddingException, IllegalBlockSizeException, InvalidAlgorithmParameterException, UnsupportedEncodingException, NoSuchPaddingException, NoSuchAlgorithmException {
    String plainTextId = "100000";
    cipher = Cipher.getInstance("Blowfish/OFB/NoPadding");
    cipher.init(Cipher.ENCRYPT_MODE, keySpec, initVector);
    byte[] cipherBytes = cipher.doFinal(plainTextId.getBytes("UTF-8"));
    String cipherTextId = bytesToHex(cipherBytes);
    return cipherTextId;
  }

  public static String decryptPrivateURL(String cipherTextId) throws InvalidKeyException, BadPaddingException, IllegalBlockSizeException, InvalidAlgorithmParameterException, UnsupportedEncodingException, NoSuchPaddingException, NoSuchAlgorithmException {
    cipher = Cipher.getInstance("Blowfish/OFB/NoPadding");
    cipher.init(Cipher.DECRYPT_MODE, keySpec, initVector);
    byte[] plainBytes = cipher.doFinal(hexToBytes(cipherTextId));

//    System.out.println("orig hex " + bytesToHex(plainBytes));
//    byte[] copy = Arrays.copyOf(plainBytes, plainBytes.length);
//    copy[copy.length - 1]++;
//    System.out.println("mal hex " + bytesToHex(copy));

    String plainTextId = new String(plainBytes, "UTF-8");
    return plainTextId;
  }
}
