package br.com.testautomacao;

import org.junit.After;
import org.junit.Assert;
import org.junit.Before;
import org.junit.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;



public class testeWeb {
	
	String url;
	WebDriver driver;

	@Before
	public void start() {
		
		url = "http://focusautomacao.com.br/focus_m.p";
		System.setProperty("webdriver.chrome.driver", "C:\\Users\\webca\\OneDrive\\Documentos\\UNICAP\\ENGENHARIA DE SOFTWARE\\chromedrive.exe");
		driver = new ChromeDriver();
		driver.manage().window().maximize();
	}
	
	@After
	public void end() {

		driver.close();
		
	}
	
	@Test
	public void test() throws InterruptedException {
		
	driver.get(url);
	driver.findElement(By.id("inputEmail")).sendKeys("admin_gestor");
	driver.findElement(By.id("inputPassword")).sendKeys("gestor@1234");
	driver.findElement(By.id("Entrar")).click();
	Assert.assertTrue(driver.getPageSource().contains("Ana Claudia"));
	Assert.assertFalse("Título da página corresponde o esperado", driver.getTitle().contentEquals("FOCUS M.P"));
	
	Thread.sleep(5000);
	
	
	}
	
}
