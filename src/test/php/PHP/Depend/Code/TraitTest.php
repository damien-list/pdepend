<?php
/**
 * This file is part of PHP_Depend.
 *
 * PHP Version 5
 *
 * Copyright (c) 2008-2012, Manuel Pichler <mapi@pdepend.org>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Manuel Pichler nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  QualityAssurance
 * @package   PHP_Depend
 * @author    Manuel Pichler <mapi@pdepend.org>
 * @copyright 2008-2012 Manuel Pichler. All rights reserved.
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   SVN: $Id$
 * @link      http://pdepend.org/
 * @since     0.11.0
 */

require_once dirname(__FILE__) . '/../AbstractTest.php';

/**
 * Test case for the {@link PHP_Depend_Code_Trait} class.
 *
 * @category  QualityAssurance
 * @package   PHP_Depend
 * @author    Manuel Pichler <mapi@pdepend.org>
 * @copyright 2008-2012 Manuel Pichler. All rights reserved.
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   Release: @package_version@
 * @link      http://pdepend.org/
 * @since     0.11.0
 *
 * @covers PHP_Depend_Code_Trait
 * @covers PHP_Depend_Code_AbstractType
 * @group pdepend
 * @group pdepend::code
 * @group unittest
 */
class PHP_Depend_Code_TraitTest extends PHP_Depend_AbstractTest
{
    /**
     * testTraitHasExpectedStartLine
     *
     * @return void
     */
    public function testTraitHasExpectedStartLine()
    {
        $trait = $this->getFirstTraitForTest();
        $this->assertEquals(5, $trait->getStartLine());
    }

    /**
     * testTraitHasExpectedEndLine
     *
     * @return void
     */
    public function testTraitHasExpectedEndLine()
    {
        $trait = $this->getFirstTraitForTest();
        $this->assertEquals(11, $trait->getEndLine());
    }

    /**
     * testTraitHasExpectedPackage
     *
     * @return void
     */
    public function testTraitHasExpectedPackage()
    {
        $trait = $this->getFirstTraitForTest();
        $this->assertEquals('org.pdepend', $trait->getPackage()->getName());
    }

    /**
     * testTraitHasExpectedNamespace
     *
     * @return void
     */
    public function testTraitHasExpectedNamespace()
    {
        $trait = $this->getFirstTraitForTest();
        $this->assertEquals('org\pdepend\code', $trait->getPackage()->getName());
    }

    /**
     * testGetPackageNameReturnsExpectedName
     *
     * @return void
     */
    public function testGetPackageNameReturnsExpectedName()
    {
        $trait = $this->getFirstTraitForTest();
        $this->assertEquals('org\pdepend\code', $trait->getPackageName());
    }

    /**
     * testGetMethodsReturnsExpectedNumberOfMethods
     *
     * @return void
     */
    public function testGetMethodsReturnsExpectedNumberOfMethods()
    {
        $trait = $this->getFirstTraitForTest();
        $this->assertEquals(3, count($trait->getMethods()));
    }

    /**
     * testMagicWakeupCallsRegisterTraitOnBuilderContext
     *
     * @return void
     */
    public function testMagicWakeupCallsRegisterTraitOnBuilderContext()
    {
        $trait = new PHP_Depend_Code_Trait(__FUNCTION__);

        $context = $this->getMockBuilder('PHP_Depend_Builder_Context')
            ->disableOriginalClone()
            ->getMock();
        $context->expects($this->once())
            ->method('registerTrait')
            ->with($this->isInstanceOf(PHP_Depend_Code_Trait::CLAZZ));

        $trait->setContext($context);

        $trait->__wakeup();
    }

    /**
     * Returns the first trait found the code under test.
     *
     * @return PHP_Depend_Code_Trait
     */
    protected function getFirstTraitForTest()
    {
        return $this->parseCodeResourceForTest()
            ->current()
            ->getTypes()
            ->current();
    }
}