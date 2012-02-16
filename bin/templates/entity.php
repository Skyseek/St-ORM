<?php
echo "<?php";
?>

/** 
 * This file was generate by Skyseek's StORM System.
 * 
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND APPLE HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 */

<?php if($this->namespace !== null): ?>
namespace <?php echo $this->namespace; ?>;
<?php endif; ?>

require_once 'base/<?php echo $this->name; ?>.php';

/**
 * <?php echo $this->name; ?> Entity
 *
 * @author     Skyseek's StORM
 */
class <?php echo $this->name; ?> extends <?php echo $this->name; ?>Base 
{
	
}