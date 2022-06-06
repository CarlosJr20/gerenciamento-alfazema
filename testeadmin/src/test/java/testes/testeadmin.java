package testes;

import static org.junit.Assert.*;

import org.junit.After;
import org.junit.Before;
import org.junit.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;

public class testeadmin {
	
	private WebDriver driver;

	@Before
	public void setUp() throws Exception {
		System.setProperty("webdriver.chrome.driver", "C:\\drivers\\chromedriver.exe");
		driver = new ChromeDriver();
	}

	@After
	public void tearDown() throws Exception {
		driver.quit();
	}

	@Test
	public void test() throws InterruptedException {
		driver.get("http://focusautomacao.com.br/focus_m.p/apl_Login/apl_Login.php");
		assertTrue("Titulo da pagina difere do esperado",driver.getTitle().contentEquals("FOCUS"));
		driver.findElement(By.id("inputEmail")).sendKeys("admin_gestor");
		driver.findElement(By.id("inputPassword")).sendKeys("gestor@1234");
		Thread.sleep(10000);

	}

}